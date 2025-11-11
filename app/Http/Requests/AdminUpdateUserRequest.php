<?php

/*
 * AdminUpdateUserRequest.php
 * Request class for updating user data.
 * Author: Santiago Manco
 */

namespace App\Http\Requests;

// Laravel / framework
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class AdminUpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'username' => 'required|unique:users,username,'.$userId,
            'email' => 'required|email|unique:users,email,'.$userId,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,customer',
            'balance' => 'required|integer|min:0',
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Username
            'username.required' => Lang::get('validation.custom.username.required'),
            'username.unique' => Lang::get('validation.custom.username.unique'),

            // Email
            'email.required' => Lang::get('validation.custom.email.required'),
            'email.email' => Lang::get('validation.custom.email.email'),
            'email.unique' => Lang::get('validation.custom.email.unique'),

            // Password (optional update)
            'password.required' => Lang::get('validation.custom.password.required'),
            'password.min' => Lang::get('validation.custom.password.min'),
            'password.confirmed' => Lang::get('validation.custom.password.confirmed'),

            // Role
            'role.required' => Lang::get('validation.custom.role.required'),
            'role.in' => Lang::get('validation.custom.role.in'),

            // Balance
            'balance.required' => Lang::get('validation.custom.balance.required'),
            'balance.integer' => Lang::get('validation.custom.balance.integer'),
            'balance.numeric' => Lang::get('validation.custom.balance.numeric'),
            'balance.min' => Lang::get('validation.custom.balance.min'),
        ];
    }

    /**
     * Custom attribute names.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'username' => Lang::get('validation.attributes.username'),
            'email' => Lang::get('validation.attributes.email'),
            'password' => Lang::get('validation.attributes.password'),
            'role' => Lang::get('validation.attributes.role'),
            'balance' => Lang::get('validation.attributes.balance'),
        ];
    }
}
