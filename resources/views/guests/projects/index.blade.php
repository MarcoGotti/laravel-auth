@extends('layouts.app')

@section('content')
    <header class="bg-danger text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Projects' list
            </h1>
            <a class="btn btn-dark" href="{{ route('welcome') }}">Home</a>
        </div>
    </header>



    <div class="container p-5">
        <div class="row g-3">

            @forelse ($projects as $project)
                <div class="col-3">
                    <div class="card">

                        <a href="{{ route('projects.show', $project) }}" class="overflow-y-hidden"
                            style="aspect-ratio: 4 / 3;">
                            @if (Str::startsWith($project->cover_image, 'https://'))
                                <img class="card-img-top" src="{{ $project->cover_image }}" alt="no image">
                            @else
                                <img class="card-img-top" src="{{ asset('storage/' . $project->cover_image) }}"
                                    alt="no image">
                            @endif
                        </a>

                        <div class="card-body">
                            <h3>{{ $project->name }}</h3>
                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12">
                    <p>no projects here</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
