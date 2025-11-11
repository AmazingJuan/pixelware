<?php

/*
 * RegisterUserRequest.php
 * Request class for validating user registration data.
 * Author: Juan Avendaño
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'username.required' => Lang::get('validation.custom.username.required'),
            'username.unique' => Lang::get('validation.custom.username.unique'),
            'email.required' => Lang::get('validation.custom.email.required'),
            'email.email' => Lang::get('validation.custom.email.email'),
            'email.unique' => Lang::get('validation.custom.email.unique'),
            'password.required' => Lang::get('validation.custom.password.required'),
            'password.min' => Lang::get('validation.custom.password.min'),
            'password.confirmed' => Lang::get('validation.custom.password.confirmed'),
            'address.required' => Lang::get('validation.custom.address.required'),
            'role.in' => Lang::get('validation.custom.role.in'),
            'balance.numeric' => Lang::get('validation.custom.balance.numeric'),
            'balance.min' => Lang::get('validation.custom.balance.min'),
        ];
    }

    /**
     * Get custom attributes for validator errors.
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
