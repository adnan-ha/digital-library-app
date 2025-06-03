<?php

namespace App\Repositories\BookRepository;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookRepositoryInterface
{
  public function getAll(?string $search = null, ?int $categoryId = null): LengthAwarePaginator;

  public function create(array $data): Book;

  public function update(Book $book, array $data): bool;

  public function delete(Book $book): ?bool;

  public function show(int $id): ?Book;

  public function incrementDownloads(Book $book): bool;
}
