<?php

/*
 * UpdateUserRequest.php
 * Request class for updating user data.
 * Author: Santiago Manco
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->getId();

        return [
            'username' => 'required|unique:users,username,'.$userId,
            'email' => 'required|email|unique:users,email,'.$userId,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,customer',
            'balance' => 'required|integer|min:0',
        ];
    }
}
