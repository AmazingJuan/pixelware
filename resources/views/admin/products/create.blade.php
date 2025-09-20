@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/products/specs.js') }}"></script>
@endpush

@section('content')
    <div class="container">
        <div class="bg-dark text-light rounded shadow-lg p-4 p-sm-5">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h2 class="h4 text-info fw-bold mb-1">@lang('admin.products.title')</h2>
                    <p class="mb-0 text-muted small">Crea un producto nuevo y configura sus atributos</p>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back', [], null)
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-12">
                    <label for="name" class="form-label fw-semibold text-info">@lang('admin.products.attributes.name')</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required>
                </div>

                <div class="col-12">
                    <label for="description" class="form-label fw-semibold text-info">@lang('admin.products.attributes.description')</label>
                    <textarea name="description" id="description" rows="4"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required>{{ old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label for="stock" class="form-label fw-semibold text-info">@lang('admin.products.attributes.stock')</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required min="0">
                </div>

                <div class="col-md-6">
                    <label for="price" class="form-label fw-semibold text-info">@lang('admin.products.attributes.price')</label>
                    <input type="number" name="price" id="price" value="{{ old('price') }}"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required min="0"
                        step="0.01">
                </div>

                <div class="col-12">
                    <label for="category" class="form-label fw-semibold text-info">@lang('admin.products.attributes.category')</label>
                    <input type="text" name="category" id="category" value="{{ old('category') }}"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-info">@lang('admin.products.attributes.specs')</label>

                    <!-- Specs visual area (chips) -->
                    <div id="specs-list" class="d-flex flex-wrap gap-2 mb-2" aria-live="polite">
                        {{-- chips rendered by JS --}}
                    </div>

                    <div class="row g-2 align-items-center">
                        <div class="col-sm-5">
                            <input type="text" id="spec-key" placeholder="@lang('admin.products.placeholders.spec_key')"
                                class="form-control form-control-dark rounded-3 px-3 py-2" />
                        </div>
                        <div class="col-sm-5">
                            <input type="text" id="spec-value" placeholder="@lang('admin.products.placeholders.spec_value')"
                                class="form-control form-control-dark rounded-3 px-3 py-2" />
                        </div>
                        <div class="col-sm-2 d-grid">
                            <button type="button" id="add-spec" class="btn btn-info btn-block fw-semibold">
                                <i class="bi bi-plus-lg me-1"></i> @lang('admin.products.actions.add_spec')
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="specs" id="specs-json" value="{{ old('specs') }}">
                    <small class="text-muted d-block mt-2">@lang('admin.products.attributes.specs_hint', [], null)</small>
                </div>

                <div class="col-md-6">
                    <label for="image" class="form-label fw-semibold text-info">@lang('admin.products.attributes.image')</label>
                    <div class="input-group">
                        <input type="file" name="image" id="image" class="form-control form-control-dark"
                            accept="image/*">
                    </div>
                    <small class="text-muted">@lang('admin.products.attributes.image_hint')</small>

                    <div id="image-preview" class="mt-3" style="max-width:220px;">
                        @if (old('image_preview'))
                            <img src="{{ old('image_preview') }}" class="img-fluid rounded shadow-sm" alt="preview">
                        @endif
                    </div>
                </div>

                <div class="col-md-6 d-flex flex-column justify-content-end">
                    <div class="p-3 bg-secondary bg-opacity-10 rounded-3 h-100 d-flex flex-column justify-content-center">
                        <h6 class="mb-1 text-info fw-semibold">@lang('admin.products.preview_title', [], null)</h6>
                        <p class="mb-0 small text-muted">@lang('admin.products.preview_hint', [], null)</p>
                    </div>
                </div>

                <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary">@lang('admin.common.cancel')</a>
                    <button type="submit" class="btn btn-success fw-semibold">@lang('admin.products.actions.create')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
