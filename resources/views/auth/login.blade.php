@extends('layouts.app')

@section('title', 'Login')

@section('body')

@if ($errors->any())
    <div id="errorMsg" class="errorMsg alert alert-danger alert-dismissible fade show position-fixed start-50 translate-middle-x mt-2" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card border-0 shadow rounded-3 col-sm-9 col-md-6 col-lg-4">
                <div class="card-body p-4 p-sm-5">
                    <h5 class="card-title text-center mb-5 fw-bold fs-4">Login</h5>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
@endsection