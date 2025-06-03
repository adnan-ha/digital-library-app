@extends('dashboard.index')

@section('mainTitle', 'Categories')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between">
    <a href="{{ route('categories.create') }}" class="btn btn-primary mt-1"> <i class="fa fa-solid fa-plus pe-2"></i>Add New Category</a>
    <form action="{{ route('categories.index') }}" method="GET" class="col-12 col-md-6 col-lg-3 mt-3 mt-md-0">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="search">
            <div class="input-group-append">
                <button class="btn btn-outline-primary bg-primary text-white rounded-start-0" type="submit">search</button>
            </div>
        </div>
    </form>
</div>

<table class="table mt-3">
    <thead>
        <tr>
            <th class="text-danger" scope="col">#</th>
            <th class="text-danger" scope="col">category</th>
            <th class="text-danger" scope="col">Update</th>
            <th class="text-danger" scope="col">Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $category->name }}</td>
                <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success">update</a></td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="{{ route('categories.destroy', $category->id) }}">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="deleteModalLabel">Confirm Delete</h5>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this category!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        </div>
    </div>
</div>

@endsection