<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class Projectcontroller extends Controller
{
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(12);

        return view('guests.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('guests.projects.show', compact('project'));
    }
}
