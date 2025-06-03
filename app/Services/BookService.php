<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepository\BookRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class BookService
{
  private BookRepositoryInterface $bookRepository;

  public function __construct(BookRepositoryInterface $bookRepository)
  {
    $this->bookRepository = $bookRepository;
  }

  public function getAll(?string $search = null, ?int $categoryId = null): LengthAwarePaginator
  {
    return $this->bookRepository->getAll($search, $categoryId);
  }

  public function create(array $data): Book
  {
    $data['file'] = $data['file']->store('files/books', 'public');
    $data['image'] = $data['image']->store('images/books', 'public');

    $data['category_id'] = $data['category'];

    return $this->bookRepository->create($data);
  }

  public function update(Book $book, array $data): bool
  {
    $data['category_id'] = $data['category'];
    unset($data['category']);

    // File update
    if (isset($data['file'])) {
      if (Storage::disk('public')->exists($book->file)) {
        Storage::disk('public')->delete($book->file);
      }
      $data['file'] = $data['file']->store('files/books', 'public');
    } else {
      $data['file'] = $book->file;
    }

    // Image update
    if (isset($data['image'])) {
      if (Storage::disk('public')->exists($book->image)) {
        Storage::disk('public')->delete($book->image);
      }
      $data['image'] = $data['image']->store('images/books', 'public');
    } else {
      $data['image'] = $book->image;
    }

    return $this->bookRepository->update($book, $data);
  }


  public function delete(Book $book): ?bool
  {
    // delete file
    if (Storage::disk('public')->exists($book->file)) {
      Storage::disk('public')->delete($book->file);
    }

    // delete image
    if (Storage::disk('public')->exists($book->image)) {
      Storage::disk('public')->delete($book->image);
    }

    return $this->bookRepository->delete($book);
  }

  public function show(int $id): ?Book
  {
    return $this->bookRepository->show($id);
  }

  public function download(Book $book): string
  {
    $this->bookRepository->incrementDownloads($book);

    return storage_path("app/public/{$book->file}");
  }
}
