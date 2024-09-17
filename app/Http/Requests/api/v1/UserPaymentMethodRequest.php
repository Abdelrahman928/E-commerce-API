<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UserPaymentMethodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'card_holder_name' => ['required', 'string', 'regex:/^[A-Z]+$/'],
            'card_number' => ['required', 'numeric', 'digits:16'],
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/[0-9]{2}$/'],
            'CVV' => ['required', 'numeric', 'digits:3']
        ];
    }
}
