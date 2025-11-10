<?php

/*
 * AdminStoreUserRequest.php
 * Request class for validating user data.
 * Author: Santiago Manco
 */

namespace App\Http\Requests;

// Laravel / framework
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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

    /**
     * Custom messages for validation errors.
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

            // Password
            'password.required' => Lang::get('validation.custom.password.required'),
            'password.min' => Lang::get('validation.custom.password.min'),
            'password.confirmed' => Lang::get('validation.custom.password.confirmed'),

            // Address
            'address.required' => Lang::get('validation.custom.address.required'),
            'address.string' => Lang::get('validation.custom.address.string'),
            'address.max' => Lang::get('validation.custom.address.max'),

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
            'address' => Lang::get('validation.attributes.address'),
            'role' => Lang::get('validation.attributes.role'),
            'balance' => Lang::get('validation.attributes.balance'),
        ];
    }
}
