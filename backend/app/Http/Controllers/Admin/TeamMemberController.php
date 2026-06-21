<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index() { return view('admin.team.index', ['members' => TeamMember::orderBy('display_order')->get()]); }
    public function create() { return view('admin.team.form', ['member' => new TeamMember]); }
    public function store(Request $request) {
        $data = $request->validate(['name'=>'required|max:255','designation'=>'nullable|max:255','bio'=>'nullable','linkedin_url'=>'nullable','whatsapp_number'=>'nullable|max:20','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('photo')) { $data['photo_url'] = '/storage/' . $request->file('photo')->store('team-members','public'); }
        TeamMember::create($data);
        return redirect()->route('admin.team.index')->with('success','Member added.');
    }
    public function edit(TeamMember $team) { return view('admin.team.form', ['member' => $team]); }
    public function update(Request $request, TeamMember $team) {
        $data = $request->validate(['name'=>'required|max:255','designation'=>'nullable|max:255','bio'=>'nullable','linkedin_url'=>'nullable','whatsapp_number'=>'nullable|max:20','display_order'=>'integer','is_active'=>'boolean']);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('photo')) { $data['photo_url'] = '/storage/' . $request->file('photo')->store('team-members','public'); }
        $team->update($data);
        return redirect()->route('admin.team.index')->with('success','Member updated.');
    }
    public function destroy(TeamMember $team) { $team->delete(); return redirect()->route('admin.team.index')->with('success','Deleted.'); }
}
