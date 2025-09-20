@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-dark text-light rounded shadow-lg p-4 p-sm-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="h4 text-info fw-bold mb-1">@lang('admin.products.title')</h2>
                    <p class="mb-0 text-muted small">@lang('admin.products.subtitle', [], null)</p>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> @lang('admin.common.create')
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (count($viewData['products']) === 0)
                <div class="alert alert-info text-center my-5 py-5">
                    <i class="bi bi-box-seam display-4 d-block mb-3 text-info"></i>
                    <div class="fs-5">@lang('admin.products.empty')</div>
                    <div class="mt-3">
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover text-light align-middle mb-0">
                        <thead class="text-secondary small" style="background-color: #0f1724;">
                            <tr>
                                <th class="text-info">@lang('admin.products.attributes.id')</th>
                                <th>@lang('admin.products.attributes.name')</th>
                                <th>@lang('admin.products.attributes.category')</th>
                                <th class="text-end">@lang('admin.products.attributes.price')</th>
                                <th class="text-center">@lang('admin.products.attributes.stock')</th>
                                <th class="text-center">@lang('admin.common.actions_title')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['products'] as $product)
                                <tr>
                                    <td class="text-info fw-semibold">{{ $product->getId() }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $product->getName() }}</div>
                                        <div class="small text-muted">{{ Str::limit($product->getDescription(), 60) }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">{{ $product->getCategory() }}</span>
                                    </td>
                                    <td class="text-end fw-bold">${{ $product->getFormattedPriceAttribute() }}</td>
                                    <td class="text-center">
                                        @if ($product->getStock() > 0)
                                            <span class="text-success fw-bold">{{ $product->getStock() }}</span>
                                        @else
                                            <span class="text-danger fw-semibold">@lang('admin.products.fields.out_of_stock')</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('products.show', $product) }}"
                                                class="btn btn-sm btn-outline-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal-{{ $product->getId() }}">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="confirmDeleteModal-{{ $product->getId() }}" tabindex="-1"
                                    aria-labelledby="confirmDeleteLabel-{{ $product->getId() }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light border-0 shadow-lg rounded">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title text-info fw-bold"
                                                    id="confirmDeleteLabel-{{ $product->getId() }}">
                                                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                                    @lang('admin.products.confirmations.delete.title')
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="@lang('admin.common.close')"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-2 fs-6 text-warning">
                                                    @lang('admin.products.confirmations.delete.message')
                                                </p>
                                                <p class="mb-0 small text-muted">
                                                    <strong>{{ $product->getName() }}</strong> —
                                                    {{ Str::limit($product->getDescription(), 90) }}
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-outline-secondary fw-semibold px-4"
                                                    data-bs-dismiss="modal">
                                                    @lang('admin.common.cancel')
                                                </button>
                                                <form action="{{ route('admin.products.destroy', $product) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger fw-semibold px-4">
                                                        <i class="bi bi-trash-fill me-1"></i>
                                                        @lang('admin.common.confirm')
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
