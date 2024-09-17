<?php

namespace App\Rules;

use App\Models\Category;
use App\Models\SubCategory;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ManageproductableId implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
            $productableType = request()->input('productable_type');
            
            if ($productableType === 'App\Models\Category') {
                if (!Category::find($value)) {
                    $fail('The selected category ID is invalid.');
                }
            } elseif ($productableType === 'App\Models\SubCategory') {
                if (!SubCategory::find($value)) {
                    $fail('The selected subcategory ID is invalid.');
                }
            } else {
                $fail('Invalid productable type.');
            }
    }
}







                


