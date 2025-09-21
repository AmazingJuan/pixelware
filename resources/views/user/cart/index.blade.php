@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">{{ __('cart.title') }}</h2>

    @if (count($viewData['cartProducts']) > 0)
        <div class="card shadow-sm mb-4">
            <div class="card-body p-0">
                <table class="table table-striped mb-0 align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>{{ __('cart.table.product') }}</th>
                            <th class="text-center">{{ __('cart.table.quantity') }}</th>
                            <th class="text-end">{{ __('cart.table.subtotal') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viewData['cartProducts'] as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item['product']->getName() }}</strong>
                                </td>
                                <td class="text-center">
                                    {{ $item['quantity'] }}
                                </td>
                                <td class="text-end">
                                    ${{ number_format($item['subtotal'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">{{ __('cart.summary') }}</h5>
                <p><strong>{{ __('cart.total') }}:</strong> ${{ number_format($viewData['total'], 2) }}</p>
                <p><strong>{{ __('cart.total_items') }}:</strong> {{ $viewData['totalQuantity'] }}</p>

                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="btn btn-success">
                        {{ __('cart.checkout') }}
                    </a>
                    <a href="{{ route('products') }}" class="btn btn-outline-secondary">
                        {{ __('cart.continue_shopping') }}
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info">
            {{ __('cart.empty') }}
        </div>
    @endif
</div>
@endsection
