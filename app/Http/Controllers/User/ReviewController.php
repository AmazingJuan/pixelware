<?php

/*
 * ReviewController.php
 * Controller for managing product reviews in the application.
 * Author: Juan Avendaño
*/

namespace App\Http\Controllers\User;

// Laravel / framework
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

// App
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Repositories\ReviewRepository;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    // Repository and Service instances for review management
    protected ReviewRepository $reviewRepository;

    protected ReviewService $reviewService;

    public function __construct(ReviewRepository $reviewRepository, ReviewService $reviewService)
    {
        $this->middleware('auth')->only('store'); // Ensure only auth users post reviews.
        $this->reviewRepository = $reviewRepository;
        $this->reviewService = $reviewService;
    }

    public function store(StoreReviewRequest $request, $productId): RedirectResponse
    {
        // Retrieve the validated incoming request data
        $validatedData = $request->validated();

        // Add product_id and user_id to the validated data
        $validatedData['product_id'] = $productId;
        $validatedData['user_id'] = Auth::id();

        // Use the ReviewService to create the review (it also handles product rating update)
        $this->reviewService->createReview($validatedData);

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }
}
