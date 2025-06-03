<?php

namespace App\Repositories\BookRepository;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BookRepository implements BookRepositoryInterface
{
  public function getAll(?string $search = null, ?int $categoryId = null): LengthAwarePaginator
  {
    return Book::with('category')
      ->when($search, function ($query, $search) {
        $query->where('title', 'like', "%{$search}%");
      })
      ->when($categoryId, function ($query, $categoryId) {
        $query->where('category_id', $categoryId);
      })
      ->orderBy('created_at', 'desc')
      ->paginate('10');
  }

  public function create(array $data): Book
  {
    return Book::create($data);
  }

  public function update(Book $book, array $data): bool
  {
    return $book->update($data);
  }

  public function delete(Book $book): ?bool
  {
    return $book->delete();
  }

  public function show(int $id): ?Book
  {
    return Book::find($id);
  }

  public function incrementDownloads(Book $book): bool
  {
    return $book->increment('downloads');
  }
}
