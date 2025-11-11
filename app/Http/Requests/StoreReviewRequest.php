<?php

/*
 * StoreReviewRequest.php
 * Request class for validating product reviews.
 * Author: Juan Avendaño
 */

namespace App\Http\Requests;

// Laravel / framework
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class StoreReviewRequest extends FormRequest
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
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
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
            'rating.required' => Lang::get('validation.custom.rating.required'),
            'rating.integer' => Lang::get('validation.custom.rating.integer'),
            'rating.min' => Lang::get('validation.custom.rating.min'),
            'rating.max' => Lang::get('validation.custom.rating.max'),
            'comment.nullable' => Lang::get('validation.custom.comment.nullable'),
            'comment.string' => Lang::get('validation.custom.comment.string'),
            'comment.max' => Lang::get('validation.custom.comment.max'),
        ];
    }

    /**
     * Custom attribute names for validation errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'rating' => Lang::get('validation.attributes.rating'),
            'comment' => Lang::get('validation.attributes.comment'),
        ];
    }
}
