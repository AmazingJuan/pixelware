<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: #0f172a; color: #f8fafc;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm" style="background-color:#1E3A8A;">
        <div class="container">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand fw-bold text-light">
                {{ config('app.name') }} - @lang('Admin Dashboard')
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link text-light">@lang('app.navbar.home')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link text-light">@lang('app.navbar.products')</a>
                    </li>

                    <div class="vr bg-light mx-2 d-none d-lg-block"></div>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm"
                                   style="background-color:#60A5FA; color:#1E3A8A; margin-left:0.5rem;"
                                   href="{{ route('admin.dashboard') }}">
                                    @lang('Admin Dashboard')
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <form id="logout" action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <a role="button" class="nav-link text-light"
                                   onclick="document.getElementById('logout').submit();">Logout</a>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Title -->
    <header class="py-4 bg-secondary text-center text-light shadow-sm">
        <h1 class="m-0">@yield('page-title', __('Admin Dashboard'))</h1>
    </header>

    <!-- Main Content -->
    <main class="flex-grow-1 py-4">
        <div class="container">
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

</html>
