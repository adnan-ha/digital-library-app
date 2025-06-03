@extends('dashboard.index')

@section('mainTitle', 'Add New Category')

@section('content')

  <div class="col-8 mx-auto p-2">
    <form action="{{ route('categories.store') }}" method="POST" class="mt-4 row g-3">
        @csrf
        <div class="form-floating mb-3">
          <input type="text" class="form-control shadow-sm" id="name" name="name" placeholder="Title">
          <label for="name">Name</label>
        </div>
        <input type="submit" value="Add" class="btn btn-primary w-100 mb-3">
    </form>
  </div>

@endsection