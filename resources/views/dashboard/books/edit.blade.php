@extends('dashboard.index')

@section('mainTitle', 'Edit Book')

@section('content')
  <div class="col-10 mx-auto p-2 d-flex flex-column flex-lg-row gap-3 gap-lg-5 align-items-center">
    <img class="book_cover rounded-3" src="{{ $book->image_url }}" alt="">
    <form action="{{ route('books.update', $book->id) }}" method="POST" class="mt-4 row g-3" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
          <input type="text" class="form-control shadow-sm" id="title" name="title" value="{{ $book->title }}" placeholder="Title">
          <label for="title">Title</label>
        </div>
        <div class="form-floating mb-3">
          <textarea class="form-control shadow-sm" id="description" name="description" placeholder="Task Description" maxlength="500">{{ $book->description }}</textarea>
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
              <option value="{{ $category->id }}" @if ($book->category_id == $category->id) selected @endif>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
          <label class="form-label" for="category">category:</label>
        </div>
        <input type="submit" value="Edit" class="btn btn-primary w-100 mb-3">
    </form>
  </div>
@endsection