<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('additional-title', 'Home')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #0f172a; color: #f8fafc;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm" style="background-color:#1E3A8A;">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand fw-bold text-light">
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">

                    @auth
                        <li class="nav-item ms-3">
                            <span class="nav-link text-warning fw-bold">
                                @lang('app.navbar.balance'): ${{ auth()->user()->getFormattedBalance() }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart') }}" class="nav-link position-relative text-light">
                                @lang('app.navbar.cart')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('orders') }}" class="nav-link position-relative text-light">
                                @lang('app.navbar.orders')
                            </a>
                        </li>
                    @endauth

                    <li class="nav-item">
                        <a href="{{ route('products') }}" class="nav-link text-light">@lang('app.navbar.products')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link text-light">@lang('app.navbar.home')</a>
                    </li>

                    <div class="vr bg-light mx-2 d-none d-lg-block"></div>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">@lang('app.navbar.login')</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">@lang('app.navbar.register')</a>
                        </li>
                    @else
                        @if (auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link btn" style="background-color:#60A5FA; color:#1E3A8A; margin-left:0.5rem;"
                                    href="{{ route('admin.dashboard') }}">
                                    @lang('app.navbar.dashboard')
                                </a>
                            </li>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-light">
                                @lang('app.navbar.logout')
                            </button>
                        </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Admin Header -->
    @auth
        @if (auth()->user()->isAdmin() && request()->routeIs('admin.*'))
            <header class="py-4 bg-secondary text-center text-light shadow-sm">
                <h1 class="m-0">@lang('app.navbar.admin_dashboard')</h1>
            </header>
        @endif
    @endauth

    <!-- Main Content -->
    <main class="flex-grow-1 py-4">
        <div class="container">

            {{-- Success message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="@lang('app.close')"></button>
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="@lang('app.close')"></button>
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="@lang('app.close')"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-light text-center py-4 mt-auto" style="background-color:#1E3A8A;">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} {{ config('app.name') }}. @lang('app.footer.rights')</p>
        </div>
    </footer>

</body>

@stack('scripts')

</html>
