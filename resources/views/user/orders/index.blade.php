@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">@lang('orders.index.title')</h2>

        @if (empty($viewData['orders']) || $viewData['orders']->isEmpty())
            <div class="alert alert-info">@lang('orders.index.empty')</div>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>@lang('orders.table.id')</th>
                                <th>@lang('orders.table.date')</th>
                                <th>@lang('orders.table.status')</th>
                                <th class="text-end">@lang('orders.table.total')</th>
                                <th>@lang('orders.table.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['orders'] as $order)
                                <tr>
                                    <td>#{{ $order->getId() }}</td>
                                    <td>{{ $order->getCreatedAt()->format('Y-m-d H:i') }}</td>
                                    <td>{{ ucfirst($order->getStatus()) }}</td>
                                    <td class="text-end">${{ $order->getFormattedTotal() }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', ['order' => $order->getId()]) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            @lang('orders.table.view')
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div class="mt-3">
            <a href="{{ route('products') }}" class="btn btn-outline-secondary">@lang('orders.actions.back_to_shop')</a>
        </div>
    </div>
@endsection
