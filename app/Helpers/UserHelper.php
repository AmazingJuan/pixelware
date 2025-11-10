<?php

/*
 * UserHelper.php
 * Handles user creation and update logic.
 * Author: Juan Avendaño
 */

namespace App\Helpers;

// Models
use App\Models\User;
// Laravel / framework
use Illuminate\Support\Facades\Hash;

class UserHelper
{
    /**
     * Create a new user.
     */
    public static function create(array $data): User
    {
        $user = new User;
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->address = $data['address'];
        $user->role = $data['role'] ?? 'customer';
        $user->balance = $data['balance'] ?? 0;
        $user->save();

        return $user;
    }

    /**
     * Update an existing user.
     */
    public static function update(array $data, User $user): User
    {
        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->username = $data['username'] ?? $user->username;
        $user->email = $data['email'] ?? $user->email;
        $user->address = $data['address'] ?? $user->address;
        $user->role = $data['role'] ?? $user->role;
        $user->balance = $data['balance'] ?? $user->balance;

        $user->save();

        return $user;
    }
}
