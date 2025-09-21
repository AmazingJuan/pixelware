<?php

/*
 * AdminUserController.php
 * Controller for managing users in the admin panel.
 * Author: Santiago Manco
*/

namespace App\Http\Controllers\Admin;

// Laravel / framework
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreUserRequest;
use App\Http\Requests\AdminUpdateUserRequest;
use App\Models\User;
// App
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    // Repository and Service instances for user management
    protected UserRepository $userRepository;

    protected UserService $userService;

    public function __construct(UserRepository $userRepository, UserService $userService)
    {
        $this->userRepository = $userRepository;
        $this->userService = $userService;
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
        $validatedData = $request->validated();

        $this->userService->create($validatedData);

        return redirect()->route('admin.users')->with('success', Lang::get('admin.users.success.created'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(AdminUpdateUserRequest $request, User $user): RedirectResponse
    {
        $validatedData = $request->validated();

        if (! empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $this->userRepository->update($validatedData, $user);

        return redirect()->route('admin.users')->with('success', Lang::get('admin.users.success.updated'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userRepository->delete($user);

        return redirect()->route('admin.users')->with('success', Lang::get('admin.users.success.deleted'));
    }
}
