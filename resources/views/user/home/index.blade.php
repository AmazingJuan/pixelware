@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="py-20 text-center">
        <h1 class="text-5xl md:text-6xl font-extrabold text-cyan-400 mb-4 drop-shadow-lg">
            @lang('home.hero.title', ['app' => config('app.name')])
        </h1>
        <p class="text-xl md:text-2xl text-slate-200 mb-8">
            @lang('home.hero.subtitle')
        </p>
        <a href="{{ route('products.index') }}"
            class="inline-block px-8 py-3 bg-cyan-500 hover:bg-cyan-400 text-white font-semibold rounded-full shadow-lg transition">
            @lang('home.hero.cta')
        </a>
    </section>
@endsection
