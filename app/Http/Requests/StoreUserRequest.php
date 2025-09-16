<?php

/*
 * StoreUserRequest.php
 * Request class for validating user data.
 * Author: Santiago Manco
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'role' => 'required|in:admin,customer',
            'balance' => 'required|integer|min:0',
        ];
    }
}
