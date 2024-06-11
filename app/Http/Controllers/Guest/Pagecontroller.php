<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class Pagecontroller extends Controller
{
    public function index()
    {
        $latest_projects = Project::orderByDesc('id')->take(6)->get();
        return view('welcome', compact('latest_projects'));
    }
}
