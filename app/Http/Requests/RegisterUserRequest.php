<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'role' => 'nullable|in:admin,customer',
            'balance' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
