@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>@lang('Users')</h2>
        <a href="{{ route('users.create') }}" class="btn btn-primary">@lang('Create User')</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-dark table-hover text-light align-middle">
        <thead style="background-color:#1E3A8A;">
            <tr>
                <th>@lang('ID')</th>
                <th>@lang('Username')</th>
                <th>@lang('Email')</th>
                <th>@lang('Balance')</th>
                <th>@lang('Role')</th>
                <th>@lang('Actions')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->getId() }}</td>
                    <td>{{ $user->getUsername() }}</td>
                    <td>{{ $user->getEmail() }}</td>
                    <td>{{ $user->getBalance() }}</td>
                    <td>
                        <span class="badge {{ $user->isAdmin() ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($user->getRole()) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">@lang('Edit')</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('@lang('Are you sure?')')">@lang('Delete')</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
