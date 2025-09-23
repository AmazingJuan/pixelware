<?php

/*
 * AdminStoreProductRequest.php
 * Request for storing products in the admin panel.
 * Author: Juan Avendaño
*/

namespace App\Http\Requests;

// Laravel / framework
use Illuminate\Foundation\Http\FormRequest;

class AdminStoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|gte:0',
            'price' => 'required|numeric|gt:0',
            'category' => 'required|string|max:100',
            'specs' => 'nullable|json',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];

    }
}
