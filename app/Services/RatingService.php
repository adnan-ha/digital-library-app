<?php

namespace App\Services;

use App\Models\Rating;
use App\Repositories\RatingsRepository\RatingRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class RatingService
{
  private RatingRepositoryInterface $ratingRepository;

  public function __construct(RatingRepositoryInterface $ratingRepository)
  {
    $this->ratingRepository = $ratingRepository;
  }

  public function create(array $data): Rating
  {
    $data['user_id'] = Auth::id();

    return $this->ratingRepository->create($data);
  }

  public function find($id): ?Rating
  {
    return $this->ratingRepository->findById($id);
  }

  public function update(Rating $rating, array $data): Rating
  {
    return $this->ratingRepository->update($rating, $data);
  }

  public function delete(Rating $rating): void
  {
    $this->ratingRepository->delete($rating);
  }
}
