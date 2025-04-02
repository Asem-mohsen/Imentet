<?php 
namespace App\Http\Controllers\web\Imentet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\AddReviewRequest;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(AddReviewRequest $request)
    {
        return $this->reviewService->addReview($request->shop_item_id, $request->review, $request->rating);
    }

    public function destroy(Request $request, $id)
    {
        return $this->reviewService->removeReview($id);
    }
}
