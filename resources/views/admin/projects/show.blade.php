@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <div class="row g-0">
            <div class="col">
                <div class="">

                    @if (Str::startsWith($project->cover_image, 'https://'))
                        <img width="400" src="{{ $project->cover_image }}" alt="no image">
                    @else
                        <img width="400" src="{{ asset('storage/' . $project->cover_image) }}" alt="no image">
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="bg-dark h-100 text-white p-5">
                    <div class="metadata">
                        <strong>Types</strong> {{ $project->type ? $project->type->level : 'Unassigned' }}
                        {{-- <strong>Types</strong> {{ $project->type?->level}} --}}
                    </div>

                    <div class="technologies d-flex flex-wrap gap-1">
                        <strong>Technologies</strong>
                        @forelse ($project->technologies as $tech)
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.technologies.show', $tech) }}">{{ $tech->name }}</a>
                        @empty
                            <div class="text-warning">Still no attached technologies</div>
                        @endforelse
                    </div>

                    <h1>{{ $project->name }}</h1>
                    <p class="my-5">{{ $project->description }}</p>

                </div>
            </div>
        </div>




    </div>
@endsection
