@extends('layouts.app')

@section('content')
    <section class="container py-5">
        <h2 class="text-center text-info fw-bold mb-5 display-5">
            @lang('products.list.title')
        </h2>

        @if (count($viewData['products']) > 0)
            <div class="row g-4">
                @foreach ($viewData['products'] as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0 bg-secondary text-light">
                            <div class="card-body d-flex flex-column">
                                <h3 class="h5 fw-bold text-info mb-2 text-truncate">
                                    {{ $product->getName() }}
                                </h3>
                                <p class="small mb-4 text-light">
                                    {{ $product->getDescription() }}
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="h5 fw-bold text-info">
                                        ${{ $product->getFormattedPriceAttribute() }}
                                    </span>
                                    <a href="{{ route('products.show', $product->getId()) }}"
                                        class="btn btn-info btn-sm fw-semibold shadow">
                                        @lang('products.actions.view')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-dark text-center py-5 fw-bold" role="alert">
                @lang('products.list.empty')
            </div>
        @endif
    </section>
@endsection
