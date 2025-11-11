@extends('layouts.app')

@section('additional-title', __('cart.title'))

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm" aria-label="@lang('admin.common.back')">
                    <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
                </a>
            </div>

            <h2 class="text-info fw-bold mb-0 text-center flex-grow-1">
                <i class="bi bi-cart3 me-2"></i>@lang('cart.title')
            </h2>

            <div class="d-flex gap-2">
                <a href="{{ route('products') }}"
                    class="btn btn-outline-secondary fw-semibold d-flex align-items-center gap-1">
                    <i class="bi bi-shop"></i>
                    <span class="d-none d-md-inline">@lang('cart.continue_shopping')</span>
                </a>
                @if (count($viewData['cartItems']) > 0)
                    <a href="{{ route('checkout') }}" class="btn btn-success fw-semibold d-flex align-items-center gap-1">
                        <i class="bi bi-bag-check"></i>
                        <span class="d-none d-md-inline">@lang('cart.checkout')</span>
                    </a>
                @endif
            </div>
        </div>

        @if (count($viewData['cartItems']) > 0)
            <div class="row g-4">
                <div class="col-12 col-lg-8">
                    <div class="card shadow-sm mb-4 border-0">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="w-50">@lang('cart.table.product')</th>
                                            <th class="text-center">@lang('cart.table.quantity')</th>
                                            <th class="text-end">@lang('cart.table.price')</th>
                                            <th class="text-end">@lang('cart.table.subtotal')</th>
                                            <th class="text-center">@lang('cart.table.actions')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewData['cartItems'] as $cartItem)
                                            @php $p = $cartItem['product']; @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <img src="{{ $p->publicUrl() ? asset($p->publicUrl()) : asset('images/placeholder.png') }}"
                                                            alt="{{ $p->getName() }}" class="rounded shadow-sm"
                                                            style="width:64px; height:64px; object-fit:cover;">
                                                        <div>
                                                            <a href="{{ route('products.show', $p->getId()) }}"
                                                                class="text-info fw-semibold d-block text-decoration-none">
                                                                {{ $p->getName() }}
                                                            </a>
                                                            <small class="text-muted d-block">
                                                                {{ Str::limit($p->getDescription(), 80) }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge bg-secondary text-white px-3 py-2 shadow-sm">
                                                        {{ $cartItem['quantity'] }}
                                                    </span>
                                                </td>

                                                <td class="text-end text-info fw-bold">
                                                    ${{ $cartItem['product']->getFormattedPriceAttribute() }}
                                                </td>

                                                <td class="text-end text-info fw-bold">
                                                    ${{ $cartItem['formattedSubtotal'] }}
                                                </td>

                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-outline-danger shadow-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#removeItemModal{{ $p->getId() }}"
                                                        aria-label="@lang('cart.table.remove_item')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>

                                                    <!-- Remove Item Modal -->
                                                    <div class="modal fade" id="removeItemModal{{ $p->getId() }}"
                                                        tabindex="-1"
                                                        aria-labelledby="removeItemModalLabel{{ $p->getId() }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content bg-dark border-secondary">
                                                                <div class="modal-header border-secondary">
                                                                    <h5 class="modal-title text-light"
                                                                        id="removeItemModalLabel{{ $p->getId() }}">
                                                                        <i
                                                                            class="bi bi-exclamation-triangle text-warning me-2"></i>
                                                                        @lang('cart.modals.remove_item.title')
                                                                    </h5>
                                                                    <button type="button" class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="@lang('app.close')"></button>
                                                                </div>
                                                                <div class="modal-body text-light">
                                                                    <p>@lang('cart.modals.remove_item.message', ['product' => $p->getName()])</p>
                                                                </div>
                                                                <div class="modal-footer border-secondary">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i
                                                                            class="bi bi-x-circle me-1"></i>@lang('cart.modals.cancel')
                                                                    </button>
                                                                    <form
                                                                        action="{{ route('cart.remove', ['id' => $p->getId()]) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i
                                                                                class="bi bi-trash me-1"></i>@lang('cart.modals.confirm')
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card shadow-sm position-sticky border-0" style="top:5.5rem;">
                        <div class="card-body">
                            <h5 class="fw-semibold d-flex align-items-center gap-2">
                                <i class="bi bi-receipt text-info"></i>
                                @lang('cart.summary')
                            </h5>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">@lang('cart.total_items')</span>
                                <strong class="text-info">{{ $viewData['totalQuantity'] }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                                <span class="text-muted">@lang('cart.total')</span>
                                <strong class="text-info h5">${{ $viewData['totalPrice'] }}</strong>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ route('checkout') }}"
                                    class="btn btn-success btn-lg fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-bag-check"></i> @lang('cart.checkout')
                                </a>

                                <a href="{{ route('products') }}"
                                    class="btn btn-outline-secondary fw-semibold d-flex align-items-center justify-content-center gap-2">
                                    <i class="bi bi-shop"></i> @lang('cart.continue_shopping')
                                </a>

                                <button type="button"
                                    class="btn btn-outline-danger w-100 fw-semibold d-flex align-items-center justify-content-center gap-2"
                                    data-bs-toggle="modal" data-bs-target="#clearCartModal">
                                    <i class="bi bi-trash"></i> @lang('cart.clear_cart')
                                </button>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-muted small">
                            <i class="bi bi-info-circle me-1"></i>@lang('cart.tips')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clear Cart Modal -->
            <div class="modal fade" id="clearCartModal" tabindex="-1" aria-labelledby="clearCartModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-dark border-secondary">
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title text-light" id="clearCartModalLabel">
                                <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                                @lang('cart.modals.clear_cart.title')
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="@lang('app.close')"></button>
                        </div>
                        <div class="modal-body text-light">
                            <p>@lang('cart.modals.clear_cart.message')</p>
                        </div>
                        <div class="modal-footer border-secondary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i>@lang('cart.modals.cancel')
                            </button>
                            <form action="{{ route('cart.removeAll') }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash me-1"></i>@lang('cart.modals.confirm')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-5 shadow-sm border-0" role="alert">
                <i class="bi bi-cart-x display-4 d-block mb-3 text-info"></i>
                <p class="fw-bold mb-3">@lang('cart.empty')</p>
            </div>
        @endif
    </div>
@endsection
