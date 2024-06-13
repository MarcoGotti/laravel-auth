@extends('layouts.admin')
@section('pageTitle', 'add-new-type')
@section('content')

    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Add a new Type
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.types.index') }}">Back</a>
        </div>
    </header>

    @include('partials.validationAlert')

    <div class="container p-5">

        <form action="{{ route('admin.types.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="level" class="form-label">Type level</label>
                <input type="text" class="w-25 form-control @error('level') is-invalid @enderror" name="level"
                    id="level" aria-describedby="levelHelper" placeholder="The blair-witch project"
                    value="{{ old('level') }}">

                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div id="levelHelper" class="form-text text-muted">Type a brand new level type</div>
            </div>

            <button type="submit" class="btn btn-dark">Save</button>

        @endsection
