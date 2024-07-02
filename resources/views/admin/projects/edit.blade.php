@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Update {{ $project->name }}
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">Back</a>
        </div>
    </header>

    @include('partials.validationAlert')

    <div class="container p-5">

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Project name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    aria-describedby="nameHelper" placeholder="The blair-witch project"
                    value="{{ old('name', $project->name) }}">

                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div id="nameHelper" class="form-text text-muted">Type the name of your project</div>
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-sm" name="type_id" id="type_id">
                    <option selected disabled>Select one</option>

                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{-- !!! $project->type?->id !!! --}}
                            {{ $type->id == old('type_id', $project->type?->id) ? 'selected' : '' }}>
                            {{ $type->level }}</option>
                    @endforeach

                </select>
            </div>

            <div class="row my-5">
                <div class="col-12 mb-2 text-decoration-underline">Technologies</div>

                @forelse ($technologies as $tech)
                    <div class="col-1">
                        <div class="form-check">
                            @if ($errors->any())
                                <input class="form-check-input" type="checkbox" value="{{ $tech->id }}"
                                    id="tech-{{ $tech->id }}" name="technologies[]"
                                    {{ in_array($tech->id, old('technologies', [])) ? 'checked' : '' }} />
                            @else
                                <input class="form-check-input" type="checkbox" value="{{ $tech->id }}"
                                    id="tech-{{ $tech->id }}" name="technologies[]"
                                    {{ $project->technologies->contains($tech->id) ? 'checked' : '' }} />
                            @endif
                            <label class="form-check-label lh-1" for="tech-{{ $tech->id }}"> {{ $tech->name }}
                            </label>
                        </div>
                    </div>
                @empty
                    <div class="p-3 text-bg-warning">
                        <div>You haven't got any category in your database!</div>
                        <div>I recommand you add a few categories to relate to your photos.</div>
                    </div>
                @endforelse
            </div>

            <div class="d-flex gap-3 mb-3">
                <div class="overflow-y-hidden" style="height: 200px">
                    <img width="200" src="{{ asset('storage/' . $project->cover_image) }}" alt="">
                </div>
                <div class="mb-3">
                    <label for="cover_image" class="form-label">Upload another cover image</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image"
                        id="cover_image" placeholder="Cover image" aria-describedby="coverImageHelper" />

                    @error('cover_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="image_delete" />
                        <label class="form-check-label" for="image_delete">Check to delete the current image</label>
                    </div>

                </div>
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                    rows="5">{{ old('description', $project->description) }}</textarea>

                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div id="descriptionHelper" class="form-text text-muted">max 2000 characters</div>
            </div>

            <button type="submit" class="btn btn-dark">Update</button>

        </form>


    </div>
@endsection
