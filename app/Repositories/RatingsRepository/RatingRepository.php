<?php

namespace App\Repositories\RatingsRepository;

use App\Models\Rating;

class RatingRepository implements RatingRepositoryInterface
{
  public function create(array $data): Rating
  {
    return Rating::create($data);
  }

  public function findById(int $id): ?Rating
  {
    return Rating::find($id);
  }

  public function update(Rating $rating, array $data): Rating
  {
    $rating->update($data);

    return $rating;
  }

  public function delete(Rating $rating): void
  {
    $rating->delete();
  }
}
