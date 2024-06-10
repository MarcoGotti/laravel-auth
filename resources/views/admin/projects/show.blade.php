@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="col">
                @if (Str::startsWith($project->cover_image, 'https://'))
                    <img class="border border-black" width="400" src="{{ $project->cover_image }}" alt="no image">
                @else
                    <img width="400" src="{{ asset('storage/' . $project->cover_image) }}" alt="no image">
                @endif
            </div>
            <div class="col">
                <h1>{{ $project->name }}</h1>
                <p>{{ $project->description }}</p>
            </div>
        </div>




    </div>
@endsection
