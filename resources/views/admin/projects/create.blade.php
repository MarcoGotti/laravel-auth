@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Create a new Project
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">Back</a>
        </div>
    </header>
    <div class="container p-5">

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Project name</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelper"
                    placeholder="The blair-witch project">
                <div id="nameHelper" class="form-text text-muted">Type the name of your project</div>
            </div>

            <div class="mb-3">
                <label for="cover_image" class="form-label">Cover image</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image" placeholder=""
                    aria-describedby="imageHelper" />
                <div id="imageHelper" class="form-text">Upload an image from your device</div>
            </div>


            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                <div id="nameHelper" class="form-text text-muted">max 2000 characters</div>
            </div>

            <button type="submit" class="btn btn-dark">Submit</button>

        </form>


    </div>
@endsection
