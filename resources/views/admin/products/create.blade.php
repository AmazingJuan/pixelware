@extends('layouts.app')

@section('additional-title', __('admin.products.title'))

@push('scripts')
    <script src="{{ asset('js/products/specs.js') }}"></script>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="card bg-dark text-white shadow-lg">
            <div class="card-body">
                <h1 class="text-center text-primary mb-4">@lang('admin.products.sections.create')</h1>

                <form id="product-form" action="{{ route('admin.products.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-3">
                        <label class="form-label">@lang('admin.products.attributes.name')</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-3">
                        <label class="form-label">@lang('admin.products.attributes.description')</label>
                        <textarea name="description" rows="3" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    {{-- Stock y Precio --}}
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">@lang('admin.products.attributes.stock')</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" class="form-control">
                        </div>
                        <div class="col">
                            <label class="form-label">@lang('admin.products.attributes.price')</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="form-control">
                        </div>
                    </div>

                    {{-- Categoría --}}
                    <div class="mb-3">
                        <label class="form-label">@lang('admin.products.attributes.category')</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="form-control">
                    </div>

                    {{-- Especificaciones --}}
                    <div class="mb-3">
                        <label class="form-label">@lang('admin.products.attributes.specs')</label>

                        {{-- Contenedor vertical de specs --}}
                        <div id="specs-list" class="d-flex flex-column mb-2"></div>

                        {{-- Inputs para agregar specs --}}
                        <div class="d-flex gap-2 mb-2">
                            <input type="text" id="spec-key" placeholder="@lang('admin.products.placeholders.spec_key')" class="form-control w-50">
                            <input type="text" id="spec-value" placeholder="@lang('admin.products.placeholders.spec_value')" class="form-control w-50">
                            <button type="button" id="add-spec" class="btn btn-primary">@lang('admin.products.actions.add_spec')</button>
                        </div>

                        <input type="hidden" name="specs" id="specs-json" value="{{ old('specs') }}">
                    </div>

                    {{-- Imagen --}}
                    <div class="mb-3">
                        <label class="form-label">@lang('admin.products.attributes.image')</label>
                        <input type="file" name="image" accept="image/jpeg,image/png" class="form-control">
                        <small class="text-muted">@lang('admin.products.attributes.image_hint')</small>
                    </div>

                    <div class="text-center d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary px-5">
                            @lang('admin.common.cancel')
                        </a>
                        <button type="submit" class="btn btn-success px-5">@lang('admin.common.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
