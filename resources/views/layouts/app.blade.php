<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 min-h-screen text-slate-100">
    <!-- Navbar -->
    <nav class="bg-slate-900 shadow-lg">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <a href="#" class="text-3xl font-bold text-cyan-400 tracking-widest">{{ config('app.name') }}</a>
            <ul class="flex space-x-8 text-lg">
                <li><a href="{{ route('home') }}" class="hover:text-cyan-400 transition">@lang('app.navbar.home')</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-cyan-400 transition">@lang('app.navbar.products')</a>
                </li>
                <li><a href="#" class="hover:text-cyan-400 transition">@lang('app.navbar.contact')</a></li>
            </ul>
        </div>
    </nav>


    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 text-center py-8 mt-16">
        <div class="container mx-auto">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. @lang('app.footer.rights') </p>
        </div>
    </footer>
</body>

</html>
