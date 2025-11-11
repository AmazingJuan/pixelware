<?php

namespace App\Http\Controllers\User;

use App\Helpers\ReviewHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, int $productId): RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['product_id'] = $productId;
        $validatedData['user_id'] = Auth::id();

        ReviewHelper::createReview($validatedData);

        return redirect()->back()->with('success', Lang::get('reviews.success'));
    }
}
