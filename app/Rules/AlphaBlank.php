<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AlphaBlank implements ValidationRule
{
    public $implicit = true;

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[A-Za-z\s]+$/', $value)) {
            $fail(':attribute contains non-English characters.');
        }
    }
}
