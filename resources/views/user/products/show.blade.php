@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <div class="row g-4 bg-dark text-light rounded shadow-lg p-4">
            <!-- Product Images -->
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                <div class="w-100 bg-secondary rounded overflow-hidden mb-3 d-flex align-items-center justify-content-center"
                    style="height: 300px;">
                    {{-- Aquí irá el carrusel o la imagen principal con JS --}}
                    <div id="product-image-gallery" class="w-100 h-100 d-flex align-items-center justify-content-center">
                        {{-- Imagen principal --}}
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6 d-flex flex-column justify-content-between">
                <div>
                    <h1 class="display-5 fw-bold text-info mb-3">
                        {{ $viewData['product']->getName() }}
                    </h1>
                    @if ($viewData['product']->getAverageRating() > 0)
                        <div class="mb-2">
                            <span class="fw-semibold text-warning">
                                {{ number_format($viewData['product']->getAverageRating(), 1) }} / 5
                            </span>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($viewData['product']->getAverageRating()))
                                    <span class="text-warning">&#9733;</span>
                                @else
                                    <span class="text-secondary">&#9733;</span>
                                @endif
                            @endfor
                        </div>
                    @endif


                    <p class="fs-5 mb-4 text-light">
                        {{ $viewData['product']->getDescription() }}
                    </p>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <span class="fs-3 fw-bold text-info">
                            ${{ $viewData['product']->getFormattedPriceAttribute() }}
                        </span>
                        <span class="badge bg-info text-dark px-3 py-2">
                            {{ $viewData['product']->getCategory() }}
                        </span>
                    </div>
                    <div class="mb-4">
                        <span class="fw-semibold text-info">@lang('products.fields.stock'):</span>
                        @if ($viewData['product']->getStock() > 0)
                            <span class="text-success fw-bold">{{ $viewData['product']->getStock() }}</span>
                        @else
                            <span class="text-danger fw-bold">@lang('products.fields.out_of_stock')</span>
                        @endif
                    </div>
                    <div class="mb-4">
                        <h2 class="h5 fw-bold text-info mb-2">@lang('products.fields.specs')</h2>
                        @if (!empty($viewData['product']->getFormattedSpecsAttribute()))
                            <ul class="list-unstyled text-light">
                                @foreach ($viewData['product']->getFormattedSpecsAttribute() as $specName => $specValue)
                                    <li>
                                        <span class="fw-semibold text-info">{{ $specName }}:</span>
                                        <span>{{ $specValue }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="text-secondary fst-italic">@lang('products.fields.no_specs')</div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <form method="POST" action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}" class="d-flex align-items-center gap-2">
                        @csrf
                        <input 
                                type="number" 
                                name="quantity" 
                                value="1" 
                                min="1" 
                                class="form-control w-auto text-center"
                                style="max-width: 80px;"
                                required
                        >
                        <button type="submit" class="btn btn-info text-white fw-semibold px-4 py-2">
                            @lang('products.actions.add_to_cart')
                        </button>
                    </form>
                    <a href="{{ route('products') }}" class="btn btn-outline-info fw-semibold px-4 py-2">
                        @lang('products.actions.back')
                    </a>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h2 class="h4 fw-bold text-info mb-4">@lang('products.reviews.title')</h2>

                {{-- Review Form (only for authenticated users) --}}
                @auth
                    <div class="card bg-secondary mb-4">
                        <div class="card-body">
                            <form method="POST"
                                action="{{ route('products.reviews.store', ['id' => $viewData['product']->getId()]) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="rating" class="form-label fw-semibold">@lang('products.reviews.fields.rating')</label>
                                    <select class="form-select" id="rating" name="rating" required>
                                        <option value="">@lang('products.reviews.fields.select_rating')</option>
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}">{{ $i }} </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label fw-semibold">@lang('products.reviews.fields.comment')</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" maxlength="1000" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-info fw-semibold text-white">
                                    @lang('products.reviews.actions.submit')
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                {{-- Reviews List --}}
                @if (count($viewData['productReviews']) > 0)
                    <div class="list-group">
                        @foreach ($viewData['productReviews'] as $review)
                            <div class="list-group-item bg-dark text-light mb-3 rounded shadow-sm border-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-info">
                                        {{ $review->getUser()->getUsername() }}
                                    </span>
                                    <span>
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->getRating())
                                                <span class="text-warning">&#9733;</span>
                                            @else
                                                <span class="text-secondary">&#9733;</span>
                                            @endif
                                        @endfor
                                    </span>
                                </div>
                                <div class="mb-2">
                                    <span class="small" style="color: #b6c2cf;">
                                        {{ $review->getCreatedAt()->format('Y-m-d H:i') }}
                                    </span>
                                </div>
                                <div>
                                    {{ $review->getComment() }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="fw-semibold" style="color: #b6c2cf;">@lang('products.reviews.empty')</div>
                @endif
            </div>
        </div>
    </section>
@endsection
