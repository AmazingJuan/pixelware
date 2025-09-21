<?php

/*
 *
 * UserService.php
 * Service for creating and validating users.
 * Author: Santiago Manco
*/

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService
{
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
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'] ?? null,
            'role' => $data['role'],
            'balance' => $data['balance'] ?? 0,
        ]);
    }
}
