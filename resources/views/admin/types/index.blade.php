@extends('layouts.admin')
@section('pageTitle', 'types-list')
@section('content')

    <header class="bg-dark text-white py-4">
        <div class="container d-flex justify-content-between align-items-center">
            <h1>
                Types' list
            </h1>
            <a class="btn btn-secondary" href="{{ route('admin.types.index') }}">Back to index</a>
        </div>
    </header>

    <div class="container p-5">
        <div class="table-responsive">
            <table class="table table-dark text white">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Level</th>
                        <th scope="col">Slug</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($types as $type)
                        <tr class="align-middle">
                            <td scope="row">{{ $type->id }}</td>
                            <td>{{ $type->level }}</td>
                            <td>{{ $type->slug }}</td>
                            <td class="text-center">
                                <a class="text-white" href="{{-- {{ route('admin.types.show', $type) }} --}}">
                                    <i class="fas fa-eye fa-xs fa-fw"></i></a>

                                <!-- Modal trigger button -->
                                <a type="button" class="text-white" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $type->id }}">
                                    <i class="fas fa-trash fa-xs fa-fw"></i>
                                </a>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade text-black" id="modalId-{{ $type->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitleId-{{ $type->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId-{{ $type->id }}">
                                                    Delete type <strong>{{ $type->level }}</strong>?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-bs-dismiss="modal">
                                                    No
                                                </button>
                                                <form action="{{ route('admin.types.destroy', $type) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit">Yes</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>

                    @empty

                        <tr class="text-center">
                            <td scope="row" colspan="4">No types so far</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
    <a class="btn btn-success border border-1 position-fixed bottom-0 end-0 m-5"
        href="{{ route('admin.types.create') }}">Add a new Type</a>

@endsection
