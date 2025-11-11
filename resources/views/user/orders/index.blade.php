@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm" aria-label="@lang('admin.common.back')">
                    <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
                </a>
            </div>

            <h2 class="text-info fw-bold mb-0 text-center flex-grow-1">
                <i class="bi bi-receipt me-2"></i>@lang('orders.index.title')
            </h2>

            <div class="d-flex gap-2">
                <a href="{{ route('products') }}"
                    class="btn btn-outline-secondary fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-shop"></i>
                    <span class="d-none d-md-inline">@lang('orders.actions.back_to_shop')</span>
                </a>
            </div>
        </div>

        @if (empty($viewData['orders']) || $viewData['orders']->isEmpty())
            <div class="alert alert-info text-center py-5 shadow-sm border-0">
                <i class="bi bi-card-checklist display-4 d-block mb-3 text-info"></i>
                <p class="fw-bold mb-3">@lang('orders.index.empty')</p>
                <a href="{{ route('products') }}"
                    class="btn btn-info fw-semibold d-flex align-items-center justify-content-center gap-2 mx-auto"
                    style="max-width: 200px;">
                    <i class="bi bi-shop"></i> @lang('orders.actions.back_to_shop')
                </a>
            </div>
        @else
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th class="ps-4">@lang('orders.table.id')</th>
                                    <th>@lang('orders.table.date')</th>
                                    <th>@lang('orders.table.status')</th>
                                    <th class="text-end">@lang('orders.table.total')</th>
                                    <th class="text-center pe-4">@lang('orders.table.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData['orders'] as $order)
                                    @php $status = strtolower($order->getStatus()); @endphp
                                    <tr>
                                        <td class="ps-4">
                                            <strong class="text-info">#{{ $order->getId() }}</strong>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-calendar3 text-muted"></i>
                                                <span
                                                    class="small">{{ $order->getCreatedAt()->format('Y-m-d H:i') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($status === 'completed' || $status === 'paid')
                                                <span class="badge bg-success text-dark px-3 py-2 shadow-sm">
                                                    <i
                                                        class="bi bi-check-circle me-1"></i>{{ ucfirst($order->getStatus()) }}
                                                </span>
                                            @elseif ($status === 'pending' || $status === 'processing')
                                                <span class="badge bg-warning text-dark px-3 py-2 shadow-sm">
                                                    <i class="bi bi-clock me-1"></i>{{ ucfirst($order->getStatus()) }}
                                                </span>
                                            @elseif ($status === 'cancelled' || $status === 'refunded')
                                                <span class="badge bg-danger px-3 py-2 shadow-sm">
                                                    <i class="bi bi-x-circle me-1"></i>{{ ucfirst($order->getStatus()) }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge bg-secondary px-3 py-2 shadow-sm">{{ ucfirst($order->getStatus()) }}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-info fs-6">${{ $order->getFormattedTotal() }}</strong>
                                        </td>
                                        <td class="text-center pe-4">
                                            <a href="{{ route('orders.show', ['order' => $order->getId()]) }}"
                                                class="btn btn-sm btn-outline-primary fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-1">
                                                <i class="bi bi-eye"></i>
                                                <span class="d-none d-md-inline">@lang('orders.table.view')</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-info-circle text-info"></i>
                    <small class="text-light">
                        @lang('orders.index.total_orders', ['count' => $viewData['orders']->count()])
                    </small>
                </div>
            </div>
        @endif
    </div>
@endsection
