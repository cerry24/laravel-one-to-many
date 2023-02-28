<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::paginate(20);

        return view('guest.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $prevProject = Project::where('id', '<', $project->id)->orderBy('id', 'DESC')->first();
        $nextProject = Project::where('id', '>', $project->id)->orderBy('id')->first();

        return view('guest.projects.show', compact('project', 'prevProject', 'nextProject'));
    }
}
