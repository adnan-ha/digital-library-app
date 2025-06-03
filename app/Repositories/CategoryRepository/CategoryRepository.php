<?php

namespace App\Repositories\CategoryRepository;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
  public function getAll(): Collection
  {
    return Category::all();
  }

  public function create(array $data): Category
  {
    return Category::create($data);
  }

  public function update(Category $category, array $data): bool
  {
    return $category->update($data);
  }

  public function delete(Category $category): bool
  {
    return $category->delete();
  }

  public function search(string $query): Collection
  {
    return Category::where('name', 'like', "%{$query}%")->get();
  }
}
