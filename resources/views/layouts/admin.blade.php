<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('additional-title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <a href="{{ route('home') }}" class="brand">
            <i class="bi bi-box-seam"></i> {{ config('app.name') }}
        </a>

        <div class="nav flex-column">
            <a href="{{ route('home') }}"
                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-house"></i> @lang('app.navbar.home')
            </a>

            <a href="{{ route('products') }}"
                class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}">
                <i class="bi bi-grid"></i> @lang('app.navbar.products')
            </a>

            <a href="{{ route('cart') }}"
                class="nav-link {{ request()->routeIs('cart') ? 'active' : '' }}">
                <i class="bi bi-cart3"></i> @lang('app.navbar.cart')
            </a>

            <a href="{{ route('orders') }}"
                class="nav-link {{ request()->routeIs('orders*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> @lang('app.navbar.orders')
            </a>

            <a href="{{ route('allied.products') }}"
                class="nav-link {{ request()->routeIs('allied.products') ? 'active' : '' }}">
                <i class="bi bi-globe2"></i> @lang('products.allied_list.title')
            </a>

            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> @lang('app.navbar.dashboard')
            </a>
        </div>

        <div class="bottom-section">
            <span class="d-block text-warning fw-bold mb-3">
                <i class="bi bi-wallet2"></i> ${{ auth()->user()->getFormattedBalance() }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right"></i> @lang('app.navbar.logout')
                </button>
            </form>
        </div>
    </nav>

    <!-- Mobile Toggle -->
    <button class="menu-toggle d-lg-none" id="menuToggle">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Flash Messages -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="@lang('app.close')"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="@lang('app.close')"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="@lang('app.close')"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script>
        document.getElementById('menuToggle')?.addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
