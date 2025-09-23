@extends('layouts.app')

@section('additional-title', __('admin.users.title'))

@section('content')
    <div class="container">
        <div class="bg-dark text-light rounded shadow-lg p-4 p-sm-5">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h2 class="h4 text-info fw-bold mb-1">@lang('admin.users.sections.create')</h2>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.users.store') }}" method="POST" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label for="username" class="form-label fw-semibold text-info">@lang('admin.users.attributes.username')</label>
                    <input type="text" name="username" id="username" value="{{ old('username') }}"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required>
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label fw-semibold text-info">@lang('admin.users.attributes.email')</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required>
                </div>

                <div class="col-md-6">
                    <label for="password" class="form-label fw-semibold text-info">@lang('admin.users.attributes.password')</label>
                    <input type="password" name="password" id="password"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required>
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label fw-semibold text-info">@lang('admin.users.attributes.password_confirmation')</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required>
                </div>

                <div class="col-md-6">
                    <label for="balance" class="form-label fw-semibold text-info">@lang('admin.users.attributes.balance')</label>
                    <div class="input-group">
                        <span class="input-group-text bg-secondary text-light border-0">$</span>
                        <input type="number" name="balance" id="balance" value="{{ old('balance', 0) }}"
                            class="form-control form-control-dark border-0 rounded-3 px-3 py-2" required min="0">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <label for="address" class="form-label fw-semibold text-info">@lang('admin.users.attributes.address')</label>
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="role" class="form-label fw-semibold text-info">@lang('admin.users.attributes.role')</label>
                    <select name="role" id="role" class="form-select form-select-dark border-0 rounded-3 px-3 py-2"
                        required>
                        <option value="customer" {{ old('role', 'customer') === 'customer' ? 'selected' : '' }}>
                            @lang('admin.users.roles.customer', [], null)</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>@lang('admin.users.roles.admin', [], null)</option>
                    </select>
                </div>

                <div class="col-12 d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">@lang('admin.common.cancel')</a>
                    <button type="submit" class="btn btn-success fw-semibold">@lang('admin.common.create')</button>
                </div>
            </form>
        </div>
    </div>
@endsection
