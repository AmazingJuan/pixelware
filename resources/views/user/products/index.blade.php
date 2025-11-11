@extends('layouts.app')

@section('additional-title', __('products.list.title'))


@section('content')
    <section class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm" aria-label="@lang('admin.common.back')">
                    <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
                </a>
            </div>

            <h2 class="text-info fw-bold mb-0 flex-grow-1 text-center">
                <i class="bi bi-grid me-2"></i>@lang('products.list.title')
            </h2>

            <div class="d-flex gap-2">
                <a href="{{ route('user.products.ranking.rating') }}"
                    class="btn btn-outline-info fw-semibold shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-trophy-fill"></i>
                    <span class="d-none d-md-inline">@lang('products.ranking.title_rating')</span>
                </a>
                <a href="{{ route('user.products.ranking.sales') }}"
                    class="btn btn-outline-success fw-semibold shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span class="d-none d-md-inline">@lang('products.ranking.title_sales')</span>
                </a>
            </div>
        </div>

        @if (count($viewData['products']) > 0)
            <div class="row g-4">
                @foreach ($viewData['products'] as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 hover-shadow">
                            {{-- Image area --}}
                            @if (method_exists($product, 'getImageUrl') && $product->getImageUrl())
                                <div class="ratio ratio-4x3 overflow-hidden">
                                    <img src="{{ asset($product->publicUrl()) }}" alt="{{ $product->getName() }}"
                                        class="card-img-top object-fit-cover">
                                </div>
                            @else
                                <div class="ratio ratio-4x3 bg-dark d-flex align-items-center justify-content-center">
                                    <i class="bi bi-image fs-1 text-muted"></i>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h3 class="h6 fw-bold text-info mb-2 text-truncate" title="{{ $product->getName() }}">
                                    {{ $product->getName() }}
                                </h3>

                                <p class="small mb-3 text-muted" style="min-height:3rem;">
                                    {{ \Illuminate\Support\Str::limit($product->getDescription(), 90) }}
                                </p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span
                                            class="h5 fw-bold text-info mb-0">${{ $product->getFormattedPriceAttribute() }}</span>
                                        @if (method_exists($product, 'getStock') && $product->getStock() < 10)
                                            <span class="badge bg-warning text-dark px-2 py-1">
                                                <i class="bi bi-exclamation-circle me-1"></i>@lang('products.list.low_stock')
                                            </span>
                                        @endif
                                    </div>

                                    <div class="d-grid">
                                        <a href="{{ route('products.show', $product->getId()) }}"
                                            class="btn btn-info fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-2"
                                            aria-label="@lang('products.actions.view')">
                                            <i class="bi bi-eye"></i>
                                            @lang('products.actions.view_details')
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center align-items-center mt-4 text-muted small">
                <i class="bi bi-info-circle me-2"></i>
                @lang('products.list.total_products', ['count' => count($viewData['products'])])
            </div>
        @else
            <div class="alert alert-info text-center py-5 shadow-sm border-0" role="alert">
                <i class="bi bi-box-seam display-4 d-block mb-3 text-info"></i>
                <p class="fw-bold mb-3">@lang('products.list.empty')</p>
                <a href="{{ route('home') }}" class="btn btn-info fw-semibold">
                    <i class="bi bi-house me-2"></i>@lang('products.actions.go_home')
                </a>
            </div>
        @endif
    </section>
@endsection

@push('styles')
    <style>
        .hover-shadow {
            transition: all .2s ease-in-out;
        }

        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .2) !important;
        }

        .object-fit-cover {
            object-fit: cover;
            width: 100%;
            height: 100%;
            transition: transform .3s ease-in-out;
        }

        .hover-shadow:hover .object-fit-cover {
            transform: scale(1.05);
        }

        .ratio {
            background-color: #1a1a1a;
        }
    </style>
@endpush
