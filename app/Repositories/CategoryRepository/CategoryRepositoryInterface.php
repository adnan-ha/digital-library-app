<?php

namespace App\Repositories\CategoryRepository;

use Illuminate\Support\Collection;
use App\Models\Category;

interface CategoryRepositoryInterface
{
  public function getAll(): Collection;

  public function create(array $data): Category;

  public function update(Category $category, array $data): bool;

  public function delete(Category $category): bool;

  public function search(string $query): Collection;
}
