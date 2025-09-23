<?php

/*
 *
 * UserService.php
 * Service for creating and validating users.
 * Author: Santiago Manco
*/

namespace App\Services;

// Laravel / Illuminate classes
use App\Models\User;
use App\Repositories\UserRepository;
// App
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    // Repository instance for user management
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string'],
            'role' => ['required', 'in:admin,customer'],
            'balance' => ['nullable', 'numeric', 'min:0'],
        ]);
    }

    public function create(array $data): User
    {
        // Hash the password before storing
        $hashedPassword = Hash::make($data['password']);
        $data['password'] = $hashedPassword;

        // Return the created user
        return $this->userRepository->create($data);
    }

    public function update(array $data, User $user): User
    {
        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->userRepository->update($data, $user);
    }
}
