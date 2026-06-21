<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ClientLogo;
use Illuminate\Http\Request;

class ClientLogoController extends Controller
{
    public function index() { return view('admin.logos.index', ['logos' => ClientLogo::orderBy('display_order')->get()]); }
    public function create() { return view('admin.logos.form', ['logo' => new ClientLogo]); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|max:255','website_url'=>'nullable','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('logo')) { $data['logo_url'] = '/storage/' . $request->file('logo')->store('client-logos','public'); }
        ClientLogo::create($data);
        return redirect()->route('admin.logos.index')->with('success','Logo added.');
    }
    public function edit(ClientLogo $logo) { return view('admin.logos.form', compact('logo')); }
    public function update(Request $request, ClientLogo $logo) {
        $data = $request->validate(['name'=>'required|max:255','website_url'=>'nullable','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('logo')) { $data['logo_url'] = '/storage/' . $request->file('logo')->store('client-logos','public'); }
        $logo->update($data);
        return redirect()->route('admin.logos.index')->with('success','Updated.');
    }
    public function destroy(ClientLogo $logo) { $logo->delete(); return redirect()->route('admin.logos.index')->with('success','Deleted.'); }
}
