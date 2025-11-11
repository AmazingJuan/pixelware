@extends('layouts.app')

@section('additional-title', __('products.ranking.title_sales'))

@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-2">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
            </a>
            <h2 class="text-center text-info fw-bold mb-0 display-5 flex-grow-1">
                @lang('products.ranking.title_sales')
            </h2>
            <span></span>
        </div>

        @if (count($viewData['products']) > 0)
            <div class="row g-4 justify-content-center">
                @foreach ($viewData['products'] as $index => $product)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-lg border-0 bg-secondary text-light position-relative">
                            <div class="position-absolute top-0 end-0 m-3">
                                <span class="badge bg-info text-dark fs-6 px-3 py-2 shadow">
                                    #{{ $index + 1 }}
                                </span>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center">
                                <div class="mb-3 w-100 d-flex justify-content-center align-items-center"
                                    style="height: 180px;">
                                    <img src="{{ asset($product->getImageUrl()) }}" alt="{{ $product->getName() }}"
                                        class="img-fluid rounded shadow" style="max-height: 100%; max-width: 100%;">
                                </div>
                                <h3 class="h5 fw-bold text-info mb-2 text-center">
                                    {{ $product->getName() }}
                                </h3>
                                <div class="mb-2 text-center">
                                    <span class="fw-semibold text-success">
                                        @lang('products.ranking.times_purchased'): {{ $product->getTimesPurchased() }}
                                    </span>
                                </div>
                                <p class="small mb-3 text-light text-center">
                                    {{ $product->getDescription() }}
                                </p>
                                <div class="mb-3 d-flex justify-content-center gap-2">
                                    <span class="h5 fw-bold text-info">
                                        ${{ $product->getFormattedPriceAttribute() }}
                                    </span>
                                    <span class="badge bg-info text-dark px-3 py-2">
                                        {{ $product->getCategory() }}
                                    </span>
                                </div>
                                <div class="mb-3 text-center">
                                    <span class="fw-semibold text-info">@lang('products.fields.stock'):</span>
                                    @if ($product->getStock() > 0)
                                        <span class="text-success fw-bold">{{ $product->getStock() }}</span>
                                    @else
                                        <span class="text-danger fw-bold">@lang('products.fields.out_of_stock')</span>
                                    @endif
                                </div>
                                <a href="{{ route('products.show', $product->getId()) }}"
                                    class="btn btn-info fw-semibold text-white px-4 py-2 mt-auto shadow">
                                    @lang('products.actions.view')
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-dark text-center py-5 fw-bold" role="alert">
                @lang('products.ranking.sales_empty')
            </div>
        @endif
    </section>
@endsection
