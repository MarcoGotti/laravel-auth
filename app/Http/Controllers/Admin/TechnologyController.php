<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:technologies,name'
        ]);
        /* //Se usassi Mass-assignment: 
        $validatedData['slug'] = Str::of($validatedData['name'])->slug('-');
        Technology::create($validatedData); 
        //aggingi $fillable al Model*/
        $technology = new Technology();
        $technology->name = $validatedData['name'];
        $technology->slug = Str::of($validatedData['name'])->slug('-');
        $technology->save();

        return to_route('admin.technologies.index')->with('message', 'technology added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        //dd($technology);
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology)
    {
        //dd($request->all());
        $validatedData = $request->validate([
            'name' => ['required', Rule::unique('technologies')->ignore($technology->id)],
        ]);

        $technology->name = $validatedData['name'];
        $technology->slug = Str::of($validatedData['name'])->slug('-');
        $technology->save();

        return to_route('admin.technologies.index')->with('message', 'technology updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', "Technology successfully deleted");
    }
}
