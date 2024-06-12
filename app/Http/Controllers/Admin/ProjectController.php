<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Project::all());
        $projects = Project::orderByDesc('id')->paginate(8);;
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::of($request->name)->slug('-');

        /* $image_path = Storage::put('uploads', $request->cover_image);
        $validatedData['cover_image'] = $image_path; */

        if ($request->has('cover_image')) {

            $validatedData['cover_image'] = Storage::put('uploads', $request->cover_image);
        }

        Project::create($validatedData);

        return to_route('admin.projects.index')->with('message', 'project successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validatedData = $request->validated(); //validate
        $validatedData['slug'] = Str::of($request->name)->slug('-');

        //dd(array_key_exists('image_delete', $validatedData));

        /* Check senza il checkbox
        if ($request->has('cover_image')) {
            //check if the current post has an image
            if ($project->cover_image) {
                //if so, delete it
                Storage::delete($project->cover_image);
            }
            //and upload the new image            
            $validatedData['cover_image'] = Storage::put('uploads', $request->cover_image);
        } */

        if ($request->has('cover_image') || (!array_key_exists('image_delete', $validatedData))) {
            //check if the current post has an image
            if ($project->cover_image) {
                //if so, delete it
                Storage::delete($project->cover_image);
            }
            //and upload the new image  
            if ($request->has('cover_image')) {
                $validatedData['cover_image'] = Storage::put('uploads', $request->cover_image);
            } else {
                $validatedData['cover_image'] = '';
            }
        }

        $project->update($validatedData); //update

        return to_route('admin.projects.index')->with('message', 'Project updated successfully'); //redirect

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {

            Storage::delete($project->cover_image);
        }

        $project->delete(); //delete resource

        return to_route('admin.projects.index')->with('message', "project successfully deleted");
    }
}
