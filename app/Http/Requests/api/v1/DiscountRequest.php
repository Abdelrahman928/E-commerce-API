<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
            'product_ids' => ['sometimes', 'array'],
            'product_ids.*' => ['exists:products,id'],
            'category_ids' => ['sometimes', 'array'],
            'category_ids.*' => ['exists:categories,id'],
            'subcategory_ids' => ['sometimes', 'array'],
            'subcategory_ids.*' => ['exists:sub_categories,id'],
            'discount_percentage' => ['required', 'numeric', 'between:0,100'],
            'valid_until' => ['required', 'date'],
        ];
    }
}
