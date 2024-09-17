<?php

namespace App\Http\Requests\api\v1;

use app\Rules\ManageproductableId;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'manufacturer' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'stock' => ['required', 'integer', 'min:0'],
            'photos.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'productable_type' => ['required', 'string', 'in:App\Models\Category,App\Models\SubCategory'],
            'productable_id' => [
                'required',
                'integer',
                new ManageproductableId,
            ],
        ];
    }
}
