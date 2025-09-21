@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="py-5 text-center text-light">
        <div class="container">
            <h1 class="display-3 fw-bold text-info mb-4">
                @lang('home.hero.title', ['app' => config('app.name')])
            </h1>
            <p class="lead mb-4">
                @lang('home.hero.subtitle')
            </p>
            <a href="{{ route('products') }}" class="btn btn-info btn-lg fw-semibold shadow">
                @lang('home.hero.cta')
            </a>
        </div>
    </section>
@endsection
