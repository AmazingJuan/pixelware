<?php

/*
 *
 * UserService.php
 * Service for creating and validating users.
 * Author: Santiago Manco
*/

namespace App\Services;

use App\Models\User;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
    protected ProductRepository $userRepository;

    public function __construct(ProductRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['nullable', 'string'],
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
}
