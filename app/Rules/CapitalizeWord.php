<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CapitalizeWord implements ValidationRule
{
    public $implicit = true;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^([A-Z][a-z]*)(\s[A-Z][a-z]*)*$/', $value)) {
            $fail(':attribute is not capitalized.');
        }
    }
}