@extends('layouts.app')

@section('content')
    <h2>@lang('Edit User')</h2>

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="username">@lang('Username')</label>
            <input type="text" name="username" id="username" value="{{ $user->getUsername() }}" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label for="email">@lang('Email')</label>
            <input type="email" name="email" id="email" value="{{ $user->getEmail() }}" class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label for="password">@lang('Password') (@lang('leave blank to keep current'))</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation">@lang('Confirm Password')</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="balance">@lang('Balance')</label>
            <input type="number" name="balance" id="balance" value="{{ $user->getBalance() }}" class="form-control"
                required min="0">
        </div>

        <div class="mb-3">
            <label for="role">@lang('Role')</label>
            <select name="role" id="role" class="form-select">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>@lang('Admin')</option>
                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>@lang('Customer')</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">@lang('Update User')</button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">@lang('Cancel')</a>
    </form>
@endsection
