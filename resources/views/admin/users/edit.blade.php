@extends('layouts.admin')

@section('additional-title', __('admin.users.title'))

@section('content')
    <h2>@lang('admin.users.sections.edit')</h2>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="username">@lang('admin.users.attributes.username')</label>
            <input type="text" name="username" id="username" value="{{ $user->getUsername() }}" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label for="email">@lang('admin.users.attributes.email')</label>
            <input type="email" name="email" id="email" value="{{ $user->getEmail() }}" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label for="password">@lang('admin.users.attributes.password') (@lang('admin.users.reminders.keep_blank'))</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation">@lang('admin.users.attributes.password_confirmation')</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="balance">@lang('admin.users.attributes.balance')</label>
            <input type="number" name="balance" id="balance" value="{{ $user->getBalance() }}" class="form-control"
                required min="0">
        </div>

        <div class="mb-3">
            <label for="address">@lang('admin.users.attributes.address')</label>
            <input type="text" name="address" id="address" value="{{ $user->getAddress() }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role">@lang('admin.users.attributes.role')</label>
            <select name="role" id="role" class="form-select">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>@lang('admin.users.roles.admin')</option>
                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>@lang('admin.users.roles.customer')</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">@lang('admin.common.update')</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">@lang('admin.common.cancel')</a>
    </form>
@endsection
