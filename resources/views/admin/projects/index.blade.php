@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Projects' list
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.dashboard') }}">Back to dash</a>
        </div>
    </header>

    <div class="container p-5">
        <div class="table-responsive">
            <table class="table table-dark text white">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($projects as $project)
                        <tr class="">
                            <td scope="row">{{ $project->id }}</td>
                            <td>

                                @if (Str::startsWith($project->cover_image, 'https://'))
                                    <img width="100" src="{{ $project->cover_image }}" alt="no image">
                                @else
                                    <img width="100" src="{{ asset('storage/' . $project->cover_image) }}"
                                        alt="no image">
                                @endif

                            </td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->slug }}</td>
                            <td>
                                <a href="{{ route('admin.projects.show', $project) }}">View</a>
                                <a href="{{ route('admin.projects.edit', $project) }}">edit</a>

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $project->id }}">
                                    Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $project->id }}">
                                                    Delete th project
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">You sure you want?</div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">
                                                    No
                                                </button>
                                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit">Yes,
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>

                    @empty

                        <tr class="text-center">
                            <td scope="row" colspan="4">No projects so far</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <a class="btn btn-success position-fixed bottom-0 end-0 m-5" href="{{ route('admin.projects.create') }}">New
        Project</a>
@endsection
