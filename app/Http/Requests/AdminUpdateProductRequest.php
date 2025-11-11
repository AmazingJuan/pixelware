<?php

/*
 * AdminUpdateProductRequest.php
 * Request for updating products in the admin panel.
 * Author: Juan Avendaño
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class AdminUpdateProductRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'specs' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
            // Product name
            'name.required' => Lang::get('validation.custom.name.required'),
            'name.string' => Lang::get('validation.custom.name.string'),
            'name.max' => Lang::get('validation.custom.name.max'),

            // Product description
            'description.required' => Lang::get('validation.custom.description.required'),
            'description.string' => Lang::get('validation.custom.description.string'),

            // Price
            'price.required' => Lang::get('validation.custom.price.required'),
            'price.numeric' => Lang::get('validation.custom.price.numeric'),
            'price.gt' => Lang::get('validation.custom.price.gt'),
            'price.min' => Lang::get('validation.custom.price.gt'), // Para mantener coherencia con el mensaje

            // Stock
            'stock.required' => Lang::get('validation.custom.stock.required'),
            'stock.integer' => Lang::get('validation.custom.stock.integer'),
            'stock.gte' => Lang::get('validation.custom.stock.gte'),
            'stock.min' => Lang::get('validation.custom.stock.gte'),

            // Category
            'category.required' => Lang::get('validation.custom.category.required'),
            'category.string' => Lang::get('validation.custom.category.string'),
            'category.max' => Lang::get('validation.custom.category.max'),

            // Specs
            'specs.nullable' => Lang::get('validation.custom.specs.nullable'),
            'specs.string' => Lang::get('validation.custom.specs.string'),
            'specs.json' => Lang::get('validation.custom.specs.json'),

            // Image
            'image.nullable' => Lang::get('validation.custom.image.nullable'),
            'image.image' => Lang::get('validation.custom.image.image'),
            'image.mimes' => Lang::get('validation.custom.image.mimes'),
            'image.max' => Lang::get('validation.custom.image.max'),
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
            'name' => Lang::get('validation.attributes.name'),
            'description' => Lang::get('validation.attributes.description'),
            'price' => Lang::get('validation.attributes.price'),
            'stock' => Lang::get('validation.attributes.stock'),
            'category' => Lang::get('validation.attributes.category'),
            'specs' => Lang::get('validation.attributes.specs'),
            'image' => Lang::get('validation.attributes.image'),
        ];
    }
}
