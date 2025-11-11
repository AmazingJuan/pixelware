<?php

/*
 * AdminStoreProductRequest.php
 * Request for storing products in the admin panel.
 * Author: Juan Avendaño
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class AdminStoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'storage_driver' => 'required|string|in:local,gcp',
        ];
    }

    public function messages(): array
    {
        return [
            // Name
            'name.required' => Lang::get('validation.custom.name.required'),
            'name.string' => Lang::get('validation.custom.name.string'),
            'name.max' => Lang::get('validation.custom.name.max'),

            // Description
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

            // Storage driver
            'storage_driver.required' => Lang::get('validation.custom.storage_driver.required'),
            'storage_driver.string' => Lang::get('validation.custom.storage_driver.string'),
            'storage_driver.in' => Lang::get('validation.custom.storage_driver.in'),
        ];
    }

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
            'storage_driver' => Lang::get('validation.attributes.storage_driver'),
        ];
    }
}
