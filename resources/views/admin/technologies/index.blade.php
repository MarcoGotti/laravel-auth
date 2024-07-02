@extends('layouts.admin')
@section('pageTitle', 'techs-list')
@section('content')

    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Technologies list
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.types.index') }}">Back to index</a>
        </div>
    </header>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container p-5">
        <div class="row">
            <div class="col-3">

                {{-- @include('partials.validationAlert') --}}

                <form action="{{ route('admin.technologies.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Add a new technology</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" aria-describedby="helpId" placeholder="es. Concert" />

                        @error('name')
                            <div class="alert alert-danger text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <button class="btn btn-sm btn-dark" type="submit">Save</button>

                </form>
            </div>
            <div class="col-9">
                <div class="table-responsive">
                    <table class="table table-dark text white">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Total Posts</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($technologies as $tech)
                                <tr class="align-middle">
                                    <td scope="row">{{ $tech->id }}</td>
                                    <td>{{ $tech->name }}</td>
                                    <td>{{ $tech->slug }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success"
                                            href="{{ route('admin.technologies.show', $tech) }}">
                                            {{ count($tech->projects) }} view</a>
                                    </td>
                                    {{-- <td>{{ count($type->projects) }}</td> --}}
                                    <td class="text-center">

                                        <!-- Modal trigger button -->
                                        <a type="button" class="text-white" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $tech->id }}">
                                            <i class="fas fa-trash fa-xs fa-fw"></i>
                                        </a>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade text-black" id="modalId-{{ $tech->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $tech->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId-{{ $tech->id }}">
                                                            Delete type <strong>{{ $tech->name }}</strong>?
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm"
                                                            data-bs-dismiss="modal">
                                                            No
                                                        </button>
                                                        <form action="{{ route('admin.technologies.destroy', $tech) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="btn btn-danger btn-sm"
                                                                type="submit">Yes</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                            @empty

                                <tr class="text-center">
                                    <td scope="row" colspan="4">No technologies so far</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
