@extends('dashboard.index')

@section('content')

<div class="px-3 px-md-5">
  <div class="d-flex flex-column flex-md-row col-12 col-md-10 col-lg-7 align-items-center gap-3 mb-3">
    <img src="{{ $book->image_url }}" class="book_cover rounded-3" alt="">
    <div class="text-center text-md-start flex-grow-1">
      <p class="fs-2 fw-bold">{{ $book->title }}</p>
      <div class="text-secondary mb-2">{{ $book->category->name }}</div>
      <div class="d-flex flex-column flex-md-row justify-content-between book_info_container text-center">
        <div><i class="fa fa-star text-warning"></i> {{ number_format($book->average_rating, 1) }} / 5 ({{ $book->ratings_count }} ratings)</div>
        <div class="mb-3"><i class="fa fa-solid fa-download"></i> {{ $book->downloads }} Downloads</div>
      </div>
      <a href="{{ $book->file_url }}" class="text-decoration-none book_link">Show Book</a>
    </div>
  </div>
  <div class="book_description mb-3">{{ $book->description }}</div>
  </div>

@endsection