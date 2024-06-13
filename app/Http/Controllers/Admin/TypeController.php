<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        //dd($request);
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::of($request->level)->slug('-');

        //dd($validatedData);
        Type::create($validatedData);

        return to_route('admin.types.index')->with('message', 'Type successfully added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //dd($type);
        /* $projects = array($type->projects);
        dd($projects); */
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete(); //delete resource

        return to_route('admin.types.index')->with('message', "type successfully deleted");
    }
}
