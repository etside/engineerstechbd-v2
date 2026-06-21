<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() { return view('admin.services.index', ['services' => Service::orderBy('display_order')->get()]); }
    public function create() { return view('admin.services.form', ['service' => new Service]); }

    public function store(Request $request)
    {
        $data = $request->validate(['title'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success','Service created.');
    }

    public function edit(Service $service) { return view('admin.services.form', compact('service')); }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate(['title'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success','Service updated.');
    }

    public function destroy(Service $service) { $service->delete(); return redirect()->route('admin.services.index')->with('success','Deleted.'); }
}
