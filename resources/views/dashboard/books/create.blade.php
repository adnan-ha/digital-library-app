@extends('dashboard.index')

@section('mainTitle', 'Add New Book')

@section('content')
  <div class="col-8 mx-auto p-2">
    <form action="{{ route('books.store') }}" method="POST" class="mt-4 row g-3" enctype="multipart/form-data">
        @csrf
        <div class="form-floating mb-3">
          <input type="text" class="form-control shadow-sm" id="title" name="title" placeholder="Title">
          <label for="title">Title</label>
        </div>
        <div class="form-floating mb-3">
          <textarea class="form-control shadow-sm" id="description" name="description" placeholder="Task Description" maxlength="500"></textarea>
          <label for="description">Description</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control shadow-sm" type="file" id="formFile" name="file" placeholder="choose file">
          <label for="formFile" class="form-label">choose file:</label>
        </div>
        <div class="form-floating mb-3">
          <input class="form-control shadow-sm" type="file" id="image" name="image" placeholder="choose cover image">
          <label for="image" class="form-label">choose cover image:</label>
        </div>
        <div class="form-floating mb-3">
          <select class="form-select shadow-sm" id="category" name="category">
            <option value="">select category</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
          <label class="form-label" for="category">category:</label>
        </div>
        <input type="submit" value="Add" class="btn btn-primary w-100 mb-3">
    </form>
  </div>
@endsection