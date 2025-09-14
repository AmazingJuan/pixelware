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
                        <div class="text-muted fst-italic">@lang('products.fields.no_specs')</div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex flex-column flex-sm-row gap-3">
                <button class="btn btn-info text-white fw-semibold px-4 py-2">
                    @lang('products.actions.buy')
                </button>
                <a href="{{ route('products.index') }}"
                    class="btn btn-outline-info fw-semibold px-4 py-2">
                    @lang('products.actions.back')
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
