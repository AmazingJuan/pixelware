@extends('layouts.app')

@section('additional-title', __('admin.users.title'))

@section('content')
    <div class="container">
        <div class="bg-dark text-light rounded shadow-lg p-4 p-sm-5">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> @lang('admin.common.back')
                    </a>
                </div>

                <div class="text-center flex-grow-1">
                    <h2 class="h4 text-info fw-bold mb-1">@lang('admin.users.title')</h2>
                </div>
                
                <div class="text-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> @lang('admin.common.create')
                    </a>
                </div>
            </div>

            @if (count($viewData['users']) === 0)
                <div class="alert alert-info text-center my-5 py-5">
                    <i class="bi bi-people-fill display-4 d-block mb-3 text-info"></i>
                    <div class="fs-5">@lang('admin.users.empty')</div>
                    <div class="mt-3">
                        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-info">
                            <i class="bi bi-plus-lg me-1"></i> @lang('admin.users.actions.create')
                        </a>
                    </div>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-dark table-hover text-light align-middle mb-0">
                        <thead class="text-secondary small" style="background-color: #0f1724;">
                            <tr>
                                <th class="text-info">@lang('admin.users.attributes.id')</th>
                                <th>@lang('admin.users.attributes.username')</th>
                                <th>@lang('admin.users.attributes.email')</th>
                                <th class="text-center">@lang('admin.users.attributes.role')</th>
                                <th class="text-end">@lang('admin.users.attributes.balance')</th>
                                <th class="text-center">@lang('admin.common.actions_title')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['users'] as $user)
                                <tr>
                                    <td class="text-info fw-semibold">{{ $user->getId() }}</td>
                                    <td class="fw-semibold">{{ $user->getUsername() }}</td>
                                    <td class="fw-semibold">{{ $user->getEmail() }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-info text-dark">{{ ucfirst($user->getRole()) }}</span>
                                    </td>
                                    <td class="text-end">${{ number_format($user->getBalance(), 0, '', ',') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning"
                                                title="@lang('admin.users.actions.edit')">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal-{{ $user->getId() }}"
                                                title="@lang('admin.users.actions.delete')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Confirmation Modal (admin) -->
                                <div class="modal fade" id="confirmDeleteModal-{{ $user->getId() }}" tabindex="-1"
                                    aria-labelledby="confirmDeleteLabel-{{ $user->getId() }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-dark text-light border-0 shadow-lg rounded">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title text-info fw-bold"
                                                    id="confirmDeleteLabel-{{ $user->getId() }}">
                                                    <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                                    @lang('admin.users.confirmations.delete.title')
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal" aria-label="@lang('admin.common.close')"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-2 fs-6 text-warning">
                                                    @lang('admin.users.confirmations.delete.message')
                                                </p>
                                                <p class="mb-0 small text-muted">
                                                    <strong>{{ $user->getUsername() }}</strong> — {{ $user->getEmail() }}
                                                </p>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-outline-secondary fw-semibold px-4"
                                                    data-bs-dismiss="modal">
                                                    @lang('admin.common.cancel')
                                                </button>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    class="d-inline">
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
