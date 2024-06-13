@extends('layouts.admin')
@section('pageTitle', 'add-new-type')
@section('content')

    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                {{ $type->level }} Projects
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.types.index') }}">Back</a>
        </div>
    </header>

    <div class="container p-5">
        <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 justify-content-around g-3">
            @forelse ($type->projects as $project)
                <div class="col">
                    <div class="card">
                        <a href="{{ route('admin.projects.show', $project) }}">
                            @if (Str::startsWith($project->cover_image, 'https://'))
                                <img class="card-img-top" src="{{ $project->cover_image }}" alt="no image">
                            @else
                                <img class="card-img-top" src="{{ asset('storage/' . $project->cover_image) }}"
                                    alt="no image">
                            @endif
                        </a>

                        <div class="card-body">
                            <h1>{{ $project->name }}</h1>
                            <p class="my-5">{{ $project->description }}</p>
                        </div>
                    </div>
                </div>

            @empty

                <div class="col-12">No Projects of this level</div>
            @endforelse

        </div>
    </div>
@endsection
