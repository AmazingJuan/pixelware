<?php

/*
 * ReviewController.php
 * Controller for managing product reviews in the application.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Repositories\ReviewRepository;
use App\Services\ReviewService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewRepository;

    protected $reviewService;

    public function __construct(ReviewRepository $reviewRepository, ReviewService $reviewService)
    {
        $this->middleware('auth')->only('store'); // Ensure only auth users post reviews.
        $this->reviewRepository = $reviewRepository;
        $this->reviewService = $reviewService;
    }

    public function store(StoreReviewRequest $request, $productId): RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['product_id'] = $productId;
        $validatedData['user_id'] = Auth::id();

        $this->reviewService->createReview($validatedData);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
}
