@extends('dashboard.index')

@section('mainTitle', 'Books')

@section('content')
    <div class="d-flex flex-column flex-lg-row justify-content-between">
        <a href="{{ route('books.create') }}" class="btn btn-primary"> <i class="fa fa-solid fa-plus pe-2"></i>Add New Book</a>
        <div class="d-flex mt-3 mt-lg-0 flex-column flex-lg-row">
            <a href="{{ route('books.index') }}" class="btn btn-primary me-2 mb-2 mb-lg-0">All Books</a>
            <form action="{{ route('books.index') }}" method="GET" class="mt-3 mt-md-0">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="search" value="{{ request('search') }}">
                    <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                        </option>
                    @endforeach
                    </select>
                    <button class="btn btn-outline-primary bg-primary text-white rounded-start-0" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover mt-3 text-center">
    <thead>
        <tr>
            <th class="text-danger" scope="col">#</th>
            <th class="text-danger" scope="col">Cover</th>
            <th class="text-danger" scope="col">Title</th>
            <th class="text-danger" scope="col">Category</th>
            <th class="text-danger" scope="col">Downloads</th>
            <th class="text-danger" scope="col">rating</th>
            <th class="text-danger" scope="col">Update</th>
            <th class="text-danger" scope="col">Delete</th>
            <th class="text-danger" scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
            <tr>
                <th scope="row" class="align-middle">
                    {{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}
                </th>
                <td class="align-middle"><img src="{{ $book->image_url }}" class="table_book_cover rounded-1" alt=""></td>
                <td class="align-middle text-start">{{ $book->title }}</td>
                <td class="align-middle">{{ $book->category->name }}</td>
                <td class="align-middle">{{ $book->downloads }}</td>
                <td class="align-middle">{{ $book->average_rating }}</td>
                <td class="align-middle"><a href="{{ route('books.edit', $book->id) }}" class="btn btn-success">update</a></td>
                <td class="align-middle">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="{{ route('books.destroy', $book->id) }}">
                    Delete
                    </button>
                </td>
                <td class="align-middle"><a href="{{ route('books.show', $book->id) }}" class="text-decoration-none">show book <i class="fa fa-solid fa-arrow-right"></i></a></td>
            </tr>
        @endforeach
    </tbody>
</table>
    </div>

<div>{{ $books->appends(request()->query())->links('pagination::bootstrap-5') }}</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-danger" id="deleteModalLabel">Confirm Delete</h5>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this book!
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
