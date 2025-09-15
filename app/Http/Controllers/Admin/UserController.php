<?php

/*
 *
 * UserController.php
 * Controller for managing users in the admin panel.
 * Author: Santiago Manco
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): RedirectResponse
    {
        return redirect()->route('admin.dashboard');
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,customer',
        ]);

        $data['password'] = Hash::make($data['password']);

        $this->userRepository->create($data);

        return redirect()->route('users.index')->with('success', __('User created successfully'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'username' => 'required|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,customer',
            'balance' => 'required|integer|min:0',
        ]);

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $this->userRepository->update($data, $user);

        return redirect()->route('users.index')->with('success', __('User updated successfully'));
    }

    public function destroy(User $user): RedirectResponse
    {

        $this->userRepository->delete($user);

        return redirect()->route('users.index')->with('success', __('User deleted successfully'));
    }
}
