<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UsernameRules implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // The regex allows letters, numbers, dots, and underscores
        if (!preg_match('/^[a-zA-Z0-9._]+$/', $value)) {
            $fail('The :attribute may only contain letters, numbers, dots, and underscores.');
        }
    }
}
