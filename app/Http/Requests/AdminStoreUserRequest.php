<?php

/*
 * AdminStoreUserRequest.php
 * Request class for validating user data.
 * Author: Santiago Manco
 */

namespace App\Http\Requests;

// Laravel / framework
use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|string|max:255',
            'role' => 'required|in:admin,customer',
            'balance' => 'required|integer|min:0',
        ];
    }
}
