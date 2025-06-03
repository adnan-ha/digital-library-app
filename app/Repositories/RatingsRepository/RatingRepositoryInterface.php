<?php

namespace App\Repositories\RatingsRepository;

use App\Models\Rating;

interface RatingRepositoryInterface
{
  public function create(array $data): Rating;

  public function findById(int $id): ?Rating;

  public function update(Rating $rating, array $data): Rating;

  public function delete(Rating $rating): void;
}
