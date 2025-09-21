@extends('layouts.app')

@section('additional-title', __('cart.title'))

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">@lang('cart.title')</h2>

        @if (count($viewData['cartProducts']) > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-body p-0">
                    <table class="table table-striped mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>@lang('cart.table.product')</th>
                                <th class="text-center">@lang('cart.table.quantity')</th>
                                <th class="text-end">@lang('cart.table.subtotal')</th>
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
                                        ${{ $item['formattedSubtotal'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">@lang('cart.summary')</h5>
                    <p><strong>@lang('cart.total'):</strong> ${{ $viewData['totalPrice'] }}</p>
                    <p><strong>@lang('cart.total_items'):</strong> {{ $viewData['totalQuantity'] }}</p>

                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="btn btn-success">
                            @lang('cart.checkout')
                        </a>
                        <a href="{{ route('products') }}" class="btn btn-outline-secondary">
                            @lang('cart.continue_shopping')
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                @lang('cart.empty')
            </div>
        @endif
    </div>
@endsection
