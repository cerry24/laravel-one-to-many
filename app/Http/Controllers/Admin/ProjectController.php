<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(14);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $project = new Project();
        $types = Type::all();

        return view('admin.projects.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|min:5|max:40|unique:projects',
            'thumbnail' => 'required|image',
            'description' => 'required|string|min:50|max:300',
            'creation_date' => 'required|date',
            'type_id' => 'required|exists:types,id'
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['thumbnail'] = Storage::put('imgs/', $data['thumbnail']);
        $newProject = new Project();
        $newProject->fill($data);
        $newProject->save();

        return redirect()->route('admin.projects.show', $newProject->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $prevProject = Project::where('id', '<', $project->id)->orderBy('id', 'DESC')->first();
        $nextProject = Project::where('id', '>', $project->id)->orderBy('id')->first();

        return view('admin.projects.show', compact('project', 'prevProject', 'nextProject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:40', Rule::unique('projects')->ignore($project->id)],
            'thumbnail' => 'required|image',
            'description' => 'required|string|min:50|max:300',
            'creation_date' => 'required|date|before_or_equal:today',
            'type_id' => 'required|exists:types,id'
        ]);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('thumbnail')) {
            if (!$project->isThumbnailAUrl()) {
                Storage::delete($project->thumbnail);
            }
            $data['thumbnail'] = Storage::put('imgs/', $data['thumbnail']);
        }
        $project->update($data);

        return redirect()->route('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Project $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (!$project->isThumbnailAUrl()) {
            Storage::delete($project->thumbnail);
        }
        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
