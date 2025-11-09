<?php

/*
 * AdminUserController.php
 * Controller for managing users in the admin panel.
 * Author: Santiago Manco
 */

namespace App\Http\Controllers\Admin;

// Laravel / framework
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreUserRequest;
use App\Http\Requests\AdminUpdateUserRequest;
use App\Models\User;
// Requests
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
// Models & Helpers
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        $viewData = ['users' => $users];

        return view('admin.users.index', compact('viewData'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(AdminStoreUserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        UserHelper::create($validatedData);

        return redirect()->route('admin.users')
            ->with('success', Lang::get('admin.users.success.created'));
    }

    public function edit(int $userId): View
    {
        $user = User::find($userId);

        if (! $user) {
            throw new ModelNotFoundException("User with ID {$userId} not found.");
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(AdminUpdateUserRequest $request, int $userId): RedirectResponse
    {
        $user = User::find($userId);

        if (! $user) {
            throw new ModelNotFoundException("User with ID {$userId} not found.");
        }

        $validatedData = $request->validated();

        UserHelper::update($validatedData, $user);

        return redirect()->route('admin.users')
            ->with('success', Lang::get('admin.users.success.updated'));
    }

    public function destroy(int $userId): RedirectResponse
    {
        $user = User::find($userId);

        if (! $user) {
            throw new ModelNotFoundException("User with ID {$userId} not found.");
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', Lang::get('admin.users.success.deleted'));
    }
}
