<?php 
namespace App\Repositories;

use App\Models\UserReview;

class ReviewRepository
{
    public function createReview(array $data)
    {
        return UserReview::create($data);
    }

    public function deleteReview($reviewId, $userId)
    {
        return UserReview::where('id', $reviewId)->where('user_id', $userId)->delete();
    }
}

