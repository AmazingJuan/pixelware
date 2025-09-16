@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">@lang('Create User')</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">@lang('Username')</label>
            <input type="text" name="username" id="username" 
                   value="{{ old('username') }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">@lang('Email')</label>
            <input type="email" name="email" id="email" 
                   value="{{ old('email') }}" 
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">@lang('Password')</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">@lang('Confirm Password')</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="balance" class="form-label">@lang('Balance')</label>
            <input type="number" name="balance" id="balance" 
                   value="{{ old('balance', 0) }}" 
                   class="form-control" required min="0">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">@lang('Role')</label>
            <select name="role" id="role" class="form-select" required>
                <option value="" disabled {{ old('role') ? '' : 'selected' }}>@lang('Select a role')</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>@lang('Admin')</option>
                <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>@lang('Customer')</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">@lang('Create User')</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
        </div>
    </form>
</div>
@endsection
