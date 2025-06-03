@extends('layouts.app')

@section('title', 'Dashboard')

@section('body')

  <div class="d-flex vh-100 ">
    <!-- Sidebar -->
    <div class="sidebar vh-100 p-3 bg-dark text-white d-flex flex-column">
      <div class="sidebar-header mt-2">
        <h4 class="text-center"><i class="fa fa-solid fa-dashboard me-1"></i> Dashboard</h4>
        <hr>
      </div>

      <ul class="nav flex-column flex-grow-1">
        <li class="nav-item mb-2 {{ request()->routeIs('books.index') ? 'active' : '' }}">
          <a class="nav-link px-0 text-white" href="{{ route('books.index') }}">
            📚 Books
          </a>
        </li>
        <li class="nav-item mb-2 {{ request()->routeIs('categories.index') ? 'active' : '' }}">
          <a class="nav-link px-0 text-white" href="{{ route('categories.index') }}">
            🗂️ Categories
          </a>
        </li>
      </ul>
      <div>
        <a href="{{ route('admin.edit') }}" class="btn btn-warning mb-3"><i class="fa fa-solid fa-user me-1"></i> Edit Profile</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger logout_btn">
              logout
              <i class="fa-solid fa-right-from-bracket ms-1"></i>
            </button>
          </form>
      </div>
    </div>

    <!-- Main Content -->
    <div class="d-flex flex-column flex-grow-1">
      <nav class="navbar bg-dark mb-4"></nav>

      <div class="main-content overflow-auto">
          <div class="container">
            {{-- error message --}}
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

            {{-- success message --}}
            @if (session('success'))
              <div id="successMsg" class="successMsg alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-4 z-3" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            
            {{-- content --}}
            <h1>@yield('mainTitle')</h1>
              @yield('content')
          </div>
      </div>
    </div>
</div>

@endsection