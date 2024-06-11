@extends('layouts.app')

@section('content')
    <header class="bg-danger text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Project {{ $project->name }}
            </h1>
            <a class="btn btn-dark" href="{{ route('projects.index') }}">Back</a>
        </div>
    </header>



    <div class="container p-5">
        <div class="row">
            <div class="col-8">
                <div class="overflow-y-hidden border border-black" style="aspect-ratio: 2">
                    <img width="100%" src="{{ asset('storage/' . $project->cover_image) }}" alt="no image">
                </div>
            </div>
            <div class="col-4">
                <h1 class="text-danger">{{ $project->name }}</h1>
                <p>{{ $project->description }}</p>
            </div>
        </div>
    </div>
@endsection
