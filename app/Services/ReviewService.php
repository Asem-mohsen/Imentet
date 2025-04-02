<?php 
namespace App\Services;

use App\Repositories\ReviewRepository;
use Illuminate\Support\Facades\Auth;

class ReviewService
{
    public function __construct(protected ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function addReview($shopItemId, $reviewText, $rating)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'You must be logged in to submit a review.'], 403);
        }

        $data = [
            'user_id' => Auth::id(),
            'shop_item_id' => $shopItemId,
            'review' => json_encode(['text' => $reviewText]),
            'rating' => $rating,
        ];

        $this->reviewRepository->createReview($data);

        return response()->json(['status' => 'success', 'message' => 'Review submitted successfully!']);
    }

    public function removeReview($reviewId)
    {
        $userId = Auth::id();

        $deleted = $this->reviewRepository->deleteReview($reviewId, $userId);

        if (!$deleted) {
            return response()->json(['status' => 'error', 'message' => 'Review not found or unauthorized action.'], 403);
        }

        return response()->json(['status' => 'success', 'message' => 'Review removed successfully.']);
    }
}
