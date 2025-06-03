@extends('dashboard.index')

@section('mainTitle', 'Edit Profile')

@section('content')

  <div class="col-8 mx-auto p-2">
    <form action="{{ route('admin.update') }}" method="POST" class="mt-4 row g-3">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
          <input type="text" class="form-control shadow-sm" name="name" value="{{ $admin->name }}" placeholder="name">
          <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control shadow-sm" name="email" value="{{ $admin->email }}" placeholder="email">
          <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control shadow-sm" name="password" placeholder="password">
          <label for="password">Password</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control shadow-sm" name="password_confirmation" placeholder="password_confirmation">
          <label for="password_confirmation">Confirm Password</label>
        </div>
        <input type="submit" value="Edit" class="btn btn-primary w-100 mb-3">
    </form>
  </div>

@endsection