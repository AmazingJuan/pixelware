@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-3">@lang('orders.show.title') #{{ $viewData['order']->getId() }}</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">@lang('orders.show.order_details')</h5>
                        <p>
                            <strong>@lang('orders.table.id'):</strong> {{ $viewData['order']->getId() }} <br>
                            <strong>@lang('orders.table.date'):</strong>
                            {{ $viewData['order']->getCreatedAt()->format('Y-m-d H:i') }} <br>
                            <strong>@lang('orders.table.status'):</strong> {{ ucfirst($viewData['order']->getStatus()) }}
                        </p>

                        <hr>

                        <h6 class="mb-3">@lang('orders.show.items')</h6>

                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>@lang('orders.item.product')</th>
                                    <th class="text-center">@lang('orders.item.quantity')</th>
                                    <th class="text-end">@lang('orders.item.unit_price')</th>
                                    <th class="text-end">@lang('orders.item.subtotal')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData['items'] as $item)
                                    <tr>
                                        <td>{{ $item->product->getName() }}</td>
                                        <td class="text-center">{{ $item->getQuantity() }}</td>
                                        <td class="text-end">${{ $item->getFormattedUnitPrice() }}</td>
                                        <td class="text-end">${{ $item->getFormattedSubtotal() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <a href="{{ route('orders') }}" class="btn btn-outline-secondary">@lang('orders.show.back_to_list')</a>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">@lang('orders.show.summary')</h5>

                        <p class="mb-1"><strong>@lang('orders.table.total'):</strong></p>
                        <p class="fs-4">${{ $viewData['order']->getFormattedTotal() }}</p>

                        <p class="mb-1"><strong>@lang('orders.show.paid_by'):</strong></p>
                        <p>{{ $viewData['order']->user->getUsername() }}</p>

                        <div class="mt-3">
                            <a href="{{ route('products') }}" class="btn btn-primary w-100">@lang('orders.continue_shopping')</a>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('orders.pdf', ['orderId' => $viewData['order']->getId()]) }}" 
                            class="btn btn-danger w-100">
                            <i class="bi bi-file-earmark-pdf"></i> @lang('orders.download_pdf')
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
