@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex align-items-center justify-content-between mb-3 gap-2 flex-wrap">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm" aria-label="@lang('admin.common.back')">
                    <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
                </a>
            </div>

            <h2 class="text-info fw-bold mb-0 text-center flex-grow-1">
                @lang('orders.show.title') #{{ $viewData['order']->getId() }}
            </h2>

            <div class="d-flex gap-2">
                <a href="{{ route('products') }}" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                    <i class="bi bi-shop"></i> <span class="d-none d-md-inline">@lang('orders.actions.back_to_shop')</span>
                </a>

                <a href="{{ route('orders.pdf', ['orderId' => $viewData['order']->getId()]) }}"
                    class="btn btn-danger btn-sm d-flex align-items-center gap-1" aria-label="@lang('orders.actions.download_pdf')">
                    <i class="bi bi-file-earmark-pdf"></i> <span class="d-none d-md-inline">@lang('orders.actions.download_pdf')</span>
                </a>

                <button type="button"
                    class="btn btn-outline-primary btn-sm d-flex align-items-center gap-2 px-3 py-1 shadow-sm rounded-pill"
                    onclick="window.print()" aria-label="@lang('orders.actions.print')">
                    <i class="bi bi-printer fs-5"></i>
                    <span>@lang('orders.actions.print')</span>
                </button>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-3">
                            <div>
                                <h5 class="card-title mb-1">@lang('orders.show.order_details')</h5>
                            </div>

                            <div class="text-end">
                                <div class="small text-muted">@lang('orders.table.date')</div>
                                <div class="fw-semibold">{{ $viewData['order']->getCreatedAt()->format('Y-m-d H:i') }}</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>@lang('orders.table.id'):</strong> #{{ $viewData['order']->getId() }}<br>
                            <strong>@lang('orders.table.status'):</strong>
                            @php $status = strtolower($viewData['order']->getStatus()); @endphp
                            @if ($status === 'completed' || $status === 'paid')
                                <span
                                    class="badge bg-success text-dark">{{ ucfirst($viewData['order']->getStatus()) }}</span>
                            @elseif ($status === 'pending' || $status === 'processing')
                                <span
                                    class="badge bg-warning text-dark">{{ ucfirst($viewData['order']->getStatus()) }}</span>
                            @elseif ($status === 'cancelled' || $status === 'refunded')
                                <span class="badge bg-danger">{{ ucfirst($viewData['order']->getStatus()) }}</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($viewData['order']->getStatus()) }}</span>
                            @endif
                        </div>

                        <hr>

                        <h6 class="mb-3">@lang('orders.show.items')</h6>

                        <div class="table-responsive">
                            <table class="table table-sm mb-0 align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="w-50">@lang('orders.item.product')</th>
                                        <th class="text-center">@lang('orders.item.quantity')</th>
                                        <th class="text-end">@lang('orders.item.unit_price')</th>
                                        <th class="text-end">@lang('orders.item.subtotal')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewData['items'] as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    @if (method_exists($item->product, 'getImageUrl') && $item->product->getImageUrl())
                                                        <img src="{{ asset($item->product->publicUrl()) }}"
                                                            alt="{{ $item->product->getName() }}"
                                                            style="width:56px;height:56px;object-fit:cover;"
                                                            class="rounded">
                                                    @else
                                                        <div class="bg-secondary rounded" style="width:56px;height:56px;">
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <a href="{{ route('products.show', $item->product->getId()) }}"
                                                            class="text-info fw-semibold d-block">{{ $item->product->getName() }}</a>
                                                        <small
                                                            class="text-muted">{{ Str::limit($item->product->getDescription(), 80) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $item->getQuantity() }}</td>
                                            <td class="text-end text-info fw-semibold">
                                                ${{ $item->getFormattedUnitPrice() }}</td>
                                            <td class="text-end fw-bold">${{ $item->getFormattedSubtotal() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('orders') }}" class="btn btn-outline-secondary">@lang('orders.show.back_to_list')</a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm position-sticky" style="top:1rem;">
                    <div class="card-body">
                        <h5 class="card-title mb-3">@lang('orders.show.summary')</h5>

                        <div class="mb-2 small text-muted">@lang('orders.table.total')</div>
                        <div class="fs-4 text-info fw-bold mb-3">${{ $viewData['order']->getFormattedTotal() }}</div>

                        <div class="mb-3">
                            <div class="small text-muted">@lang('orders.show.paid_by')</div>
                            <div class="fw-semibold">{{ $viewData['order']->user->getUsername() }}</div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('orders.pdf', ['orderId' => $viewData['order']->getId()]) }}"
                                class="btn btn-danger fw-semibold d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-file-earmark-pdf"></i> @lang('orders.actions.download_pdf')
                            </a>

                            <a href="{{ route('products') }}"
                                class="btn btn-outline-secondary fw-semibold">@lang('orders.actions.continue_shopping')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
