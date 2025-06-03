<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryService
{
  private CategoryRepositoryInterface $categoryRepository;

  public function __construct(CategoryRepositoryInterface $categoryRepository)
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function getAll(): Collection
  {
    return $this->categoryRepository->getAll();
  }

  public function create(array $data): Category
  {
    return $this->categoryRepository->create($data);
  }

  public function update(Category $category, array $data): bool
  {
    return $this->categoryRepository->update($category, $data);
  }

  public function delete(Category $category): bool
  {
    // delete related books files
    foreach ($category->books as $book) {
      // delete file
      if (Storage::disk('public')->exists($book->file)) {
        Storage::disk('public')->delete($book->file);
      }

      // delete image
      if (Storage::disk('public')->exists($book->image)) {
        Storage::disk('public')->delete($book->image);
      }
    }

    return $this->categoryRepository->delete($category);
  }

  public function search(string $query): Collection
  {
    return $this->categoryRepository->search($query);
  }
}
