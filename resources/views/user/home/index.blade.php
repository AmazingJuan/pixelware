@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 text-center text-light position-relative overflow-hidden">
        <div class="container position-relative" style="z-index: 2;">
            <div class="mb-4">
                <i class="bi bi-box-seam display-1 text-info mb-3 d-block"></i>
            </div>
            <h1 class="display-3 fw-bold text-info mb-4">
                @lang('home.hero.title', ['app' => config('app.name')])
            </h1>
            <p class="lead mb-5 text-light mx-auto" style="max-width: 600px;">
                @lang('home.hero.subtitle')
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('products') }}"
                    class="btn btn-info btn-lg fw-semibold shadow-sm d-flex align-items-center gap-2 px-4">
                    <i class="bi bi-grid"></i>
                    @lang('home.hero.cta')
                </a>
                @guest
                    <a href="{{ route('register') }}"
                        class="btn btn-outline-light btn-lg fw-semibold d-flex align-items-center gap-2 px-4">
                        <i class="bi bi-person-plus"></i>
                        @lang('app.navbar.register')
                    </a>
                @endguest
            </div>
        </div>

        <!-- Decorative background -->
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="z-index: 1;">
            <div class="position-absolute"
                style="top: 10%; left: 10%; width: 100px; height: 100px; background: #60A5FA; border-radius: 50%; filter: blur(40px);">
            </div>
            <div class="position-absolute"
                style="bottom: 20%; right: 15%; width: 150px; height: 150px; background: #3b82f6; border-radius: 50%; filter: blur(50px);">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-lightning-charge text-info display-4 mb-3"></i>
                            <h3 class="h5 fw-bold text-dark mb-3">@lang('home.features.fast.title')</h3>
                            <p class="text-muted small">@lang('home.features.fast.description')</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-shield-check text-success display-4 mb-3"></i>
                            <h3 class="h5 fw-bold text-dark mb-3">@lang('home.features.secure.title')</h3>
                            <p class="text-muted small">@lang('home.features.secure.description')</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0 text-center p-4">
                        <div class="card-body">
                            <i class="bi bi-star-fill text-warning display-4 mb-3"></i>
                            <h3 class="h5 fw-bold text-dark mb-3">@lang('home.features.quality.title')</h3>
                            <p class="text-muted small">@lang('home.features.quality.description')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-center">
        <div class="container">
            <div class="card shadow-sm border-0 p-5" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                <h2 class="h3 fw-bold text-light mb-3">@lang('home.cta.title')</h2>
                <p class="text-light mb-4 opacity-75">@lang('home.cta.description')</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('products') }}"
                        class="btn btn-light btn-lg fw-semibold shadow-sm d-flex align-items-center gap-2">
                        <i class="bi bi-shop"></i>
                        @lang('home.cta.shop_now')
                    </a>
                    @auth
                        <a href="{{ route('orders') }}"
                            class="btn btn-outline-light btn-lg fw-semibold d-flex align-items-center gap-2">
                            <i class="bi bi-receipt"></i>
                            @lang('app.navbar.orders')
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
