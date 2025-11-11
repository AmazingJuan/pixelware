<?php

/*
 * AdminStoreProductRequest.php
 * Request for storing products in the admin panel.
 * Author: Juan Avendaño
*/

namespace App\Http\Requests;

// Laravel / framework
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

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
            'storage_driver' => 'nullable|in:local,gcp',
        ];
    }

    /**
     * Get custom messages for validator errors.
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

            // Stock
            'stock.required' => Lang::get('validation.custom.stock.required'),
            'stock.integer' => Lang::get('validation.custom.stock.integer'),
            'stock.gte' => Lang::get('validation.custom.stock.gte'),

            // Price
            'price.required' => Lang::get('validation.custom.price.required'),
            'price.numeric' => Lang::get('validation.custom.price.numeric'),
            'price.gt' => Lang::get('validation.custom.price.gt'),

            // Category
            'category.required' => Lang::get('validation.custom.category.required'),
            'category.string' => Lang::get('validation.custom.category.string'),
            'category.max' => Lang::get('validation.custom.category.max'),

            // Specs
            'specs.nullable' => Lang::get('validation.custom.specs.nullable'),
            'specs.json' => Lang::get('validation.custom.specs.json'),

            // Image
            'image.required' => Lang::get('validation.custom.image.required'),
            'image.image' => Lang::get('validation.custom.image.image'),
            'image.mimes' => Lang::get('validation.custom.image.mimes'),
            'image.max' => Lang::get('validation.custom.image.max'),
        ];
    }

    /**
     * Get custom attribute names.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => Lang::get('validation.attributes.name'),
            'description' => Lang::get('validation.attributes.description'),
            'stock' => Lang::get('validation.attributes.stock'),
            'price' => Lang::get('validation.attributes.price'),
            'category' => Lang::get('validation.attributes.category'),
            'specs' => Lang::get('validation.attributes.specs'),
            'image' => Lang::get('validation.attributes.image'),
        ];
    }
}
