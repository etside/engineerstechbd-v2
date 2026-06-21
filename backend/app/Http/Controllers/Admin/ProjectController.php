<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderBy('display_order')->get()]);
    }

    public function create()
    {
        return view('admin.projects.form', ['project' => new Project]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|max:255',
            'description'     => 'nullable',
            'url'             => 'nullable|url',
            'features'        => 'nullable',
            'login_username'  => 'nullable|max:255',
            'login_password'  => 'nullable|max:255',
            'display_order'   => 'integer',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $data['logo_url'] = 'storage/' . $request->file('logo')->store('logos', 'public');
        }

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project created.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name'            => 'required|max:255',
            'description'     => 'nullable',
            'url'             => 'nullable|url',
            'features'        => 'nullable',
            'login_username'  => 'nullable|max:255',
            'login_password'  => 'nullable|max:255',
            'display_order'   => 'integer',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $data['logo_url'] = 'storage/' . $request->file('logo')->store('logos', 'public');
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Deleted.');
    }
}
