<?php

/*
 *
 * UserController.php
 * Controller for managing users in the admin panel.
 * Author: Santiago Manco
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreUserRequest;
use App\Http\Requests\AdminUpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        $viewData = [];

        $users = $this->userRepository->all();

        $viewData['users'] = $users;

        return view('admin.users.index', compact('viewData'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(AdminStoreUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $this->userRepository->create($data);

        return redirect()->route('admin.users')->with('success', __('User created successfully'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(AdminUpdateUserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $this->userRepository->update($data, $user);

        return redirect()->route('admin.users')->with('success', __('User updated successfully'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userRepository->delete($user);

        return redirect()->route('admin.users')->with('success', __('User deleted successfully'));
    }
}
