@extends('layouts.admin')

@section('content')
    <div class="container p-5">
        <div class="table-responsive">
            <table class="table table-dark text white">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($projects as $project)
                        <tr class="">
                            <td scope="row">{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->slug }}</td>
                            <td>
                                <a href="{{-- {{ route('admin.projects.show', $project) }} --}}">View</a>
                                |Edit|Delete
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
@endsection
