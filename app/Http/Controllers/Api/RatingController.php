<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RatingRequest;
use App\Models\Rating;
use App\Services\RatingService;
use Illuminate\Support\Facades\Auth;

class RatingController
{
    private RatingService $ratingService;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $rating = $this->ratingService->find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        if (Auth::id() != $rating->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json(['rating' => $rating]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RatingRequest $request)
    {
        $rating = $this->ratingService->create($request->validated());

        return response()->json(['rating' => $rating], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RatingRequest $request, int $id)
    {
        $rating = $this->ratingService->find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        if (Auth::id() != $rating->user_id || $request->book_id != $rating->book_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $updatedRating = $this->ratingService->update($rating, $request->validated());

        return response()->json(['message' => 'Rating was updated successfully', 'Rating' => $updatedRating]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $rating = $this->ratingService->find($id);

        if (!$rating) {
            return response()->json(['message' => 'Rating not found'], 404);
        }

        if (Auth::id() != $rating->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $this->ratingService->delete($rating);

        return response()->json(['message' => 'Rating deleted successfully']);
    }
}
