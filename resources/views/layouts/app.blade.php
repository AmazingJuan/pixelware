<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('additional-title', 'Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #0f172a; color: #f8fafc;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top" style="background-color:#1E3A8A;">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand fw-bold text-light d-flex align-items-center gap-2">
                <i class="bi bi-box-seam fs-4"></i>
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a href="{{ route('home') }}"
                            class="nav-link text-light d-flex align-items-center gap-1 {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="bi bi-house"></i> @lang('app.navbar.home')
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('products') }}"
                            class="nav-link text-light d-flex align-items-center gap-1 {{ request()->routeIs('products*') ? 'active' : '' }}">
                            <i class="bi bi-grid"></i> @lang('app.navbar.products')
                        </a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a href="{{ route('cart') }}"
                                class="nav-link text-light d-flex align-items-center gap-1 {{ request()->routeIs('cart') ? 'active' : '' }}">
                                <i class="bi bi-cart3"></i> @lang('app.navbar.cart')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('orders') }}"
                                class="nav-link text-light d-flex align-items-center gap-1 {{ request()->routeIs('orders*') ? 'active' : '' }}">
                                <i class="bi bi-receipt"></i> @lang('app.navbar.orders')
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('allied.products') }}"
                                class="nav-link text-light d-flex align-items-center gap-1 {{ request()->routeIs('allied.products') ? 'active' : '' }}">
                                <i class="bi bi-globe2"></i> @lang('products.allied_list.title')
                            </a>
                        </li>

                        <li class="nav-item d-none d-lg-block">
                            <div class="vr bg-light mx-2" style="height:24px;"></div>
                        </li>

                        <li class="nav-item">
                            <span class="nav-link text-warning fw-bold d-flex align-items-center gap-1">
                                <i class="bi bi-wallet2"></i> ${{ auth()->user()->getFormattedBalance() }}
                            </span>
                        </li>
                    @endauth

                    <li class="nav-item d-none d-lg-block">
                        <div class="vr bg-light mx-2" style="height:24px;"></div>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-light d-flex align-items-center gap-1" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> @lang('app.navbar.login')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light btn-sm ms-lg-2" href="{{ route('register') }}">
                                @lang('app.navbar.register')
                            </a>
                        </li>
                    @else
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm d-flex align-items-center gap-1 ms-lg-2"
                                    style="background-color:#60A5FA; color:#1E3A8A;" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> @lang('app.navbar.dashboard')
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="nav-link btn btn-link text-light d-flex align-items-center gap-1">
                                    <i class="bi bi-box-arrow-right"></i> @lang('app.navbar.logout')
                                </button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Admin Header -->
    @auth
        @if (auth()->user()->isAdmin() && request()->routeIs('admin.*'))
            <header class="py-3 text-center text-light shadow-sm"
                style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
                <div class="container">
                    <h1 class="m-0 h4 fw-bold d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-shield-lock"></i> @lang('app.navbar.admin_dashboard')
                    </h1>
                </div>
            </header>
        @endif
    @endauth

    <!-- Flash Messages (fixed position for better UX) -->
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
    <main class="flex-grow-1 py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-light text-center py-4 mt-auto shadow-sm" style="background-color:#1E3A8A;">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="mb-0 small">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. @lang('app.footer.rights')
                </p>
                <div class="d-flex gap-3 small">
                    <a href="{{ route('home') }}" class="text-light text-decoration-none">@lang('app.navbar.home')</a>
                    <a href="{{ route('products') }}" class="text-light text-decoration-none">@lang('app.navbar.products')</a>
                    @auth
                        <a href="{{ route('orders') }}" class="text-light text-decoration-none">@lang('app.navbar.orders')</a>
                    @endauth
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

</body>

</html>
