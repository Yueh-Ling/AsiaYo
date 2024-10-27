<?php

namespace App\Http\Requests;

use App\Exceptions\AsiaYoException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AsioYoRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->first();
        throw new AsiaYoException($errors, 400);
    }
}
