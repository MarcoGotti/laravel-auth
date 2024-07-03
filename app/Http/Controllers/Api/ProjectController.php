<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['type', 'technologies'])->orderByDesc('id')->paginate(10);
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($id)
    {

        $project = Project::with(['type', 'technologies'])->where('id', $id)->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'result' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => '404 Not found'
            ]);
        }
    }
}
