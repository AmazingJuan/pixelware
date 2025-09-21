@extends('layouts.app')

@section('additional-title', __('admin.dashboard.title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-dark text-light rounded shadow-lg p-5">
                    <h1 class="mb-4 text-info fw-bold text-center">
                        @lang('admin.dashboard.title')
                    </h1>
                    <p class="mb-5 text-center fs-5 text-secondary">
                        @lang('admin.dashboard.welcome', ['app' => config('app.name')])
                    </p>
                    <div class="row g-4 justify-content-center">
                        <div class="col-md-6">
                            <a href="{{ route('admin.users') }}" class="text-decoration-none">
                                <div class="card bg-secondary text-light h-100 shadow-sm border-0 hover-shadow">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                        <i class="bi bi-people-fill display-4 text-info mb-3"></i>
                                        <h5 class="card-title fw-bold">@lang('admin.users.title')</h5>
                                        <p class="card-text text-center">@lang('admin.users.description')</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('admin.products') }}" class="text-decoration-none">
                                <div class="card bg-secondary text-light h-100 shadow-sm border-0 hover-shadow">
                                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                        <i class="bi bi-box-seam display-4 text-info mb-3"></i>
                                        <h5 class="card-title fw-bold">@lang('admin.products.title')</h5>
                                        <p class="card-text text-center">@lang('admin.products.description')</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
