@extends('layouts.app')

@section('additional-title', 'Productos Aliados')

@section('content')
<section class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
        </a>

        <h2 class="text-info fw-bold mb-0 flex-grow-1 text-center">
            <i class="bi bi-globe2 me-2"></i>@lang('products.allied_list.title')
        </h2>
    </div>

    @if (count($products) > 0)
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                        {{-- Imagen --}}
                        <div class="ratio ratio-4x3 overflow-hidden">
                            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}"
                                class="card-img-top object-fit-cover">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h3 class="h6 fw-bold text-info mb-2 text-truncate" title="{{ $product['title'] }}">
                                {{ $product['title'] }}
                            </h3>

                            <p class="small mb-3 text-muted" style="min-height:3rem;">
                                {{ \Illuminate\Support\Str::limit($product['details'], 90) }}
                            </p>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="h5 fw-bold text-info mb-0">${{ number_format($product['price'], 0, ',', '.') }}</span>
                                    <span class="badge bg-secondary">{{ $product['category'] }}</span>
                                </div>

                                <div class="d-grid">
                                    <a href="{{ $product['link'] }}" target="_blank"
                                        class="btn btn-outline-info fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                        @lang('products.allied_list.arslonga_link')
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
            @lang('products.allied_list.total_products', ['count' => count($products)])
        </div>
    @else
        <div class="alert alert-info text-center py-5 shadow-sm border-0" role="alert">
            <i class="bi bi-box-seam display-4 d-block mb-3 text-info"></i>
            <p class="fw-bold mb-3">@lang('products.allied_list.empty')</p>
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
</style>
@endpush
