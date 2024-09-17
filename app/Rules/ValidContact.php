<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidContact implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            if(!User::where('email', $value)->exists()){
                $fail('we could not find an account with the email provided');
            }
            $fail('pleas enter a valid email address or phone number.');
        }

        if (!preg_match('/^(\+?[0-9]{1,3})?([0-9]{10,15})$/', $value)) {
            if(!User::where('phone_number', $value)->exists()){
                $fail('we could not find an account with the phone number provided');
            }
            $fail('pleas enter a valid email address or phone number.');
        }
    }
}
