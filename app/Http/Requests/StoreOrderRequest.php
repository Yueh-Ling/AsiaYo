<?php

namespace App\Http\Requests;

use App\Rules\Alphablank;
use App\Rules\CapitalizeWord;

class StoreOrderRequest extends AsioYoRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required'],
            'name' => [
                'required',
                new Alphablank(),
                new CapitalizeWord()
            ],
            'address' => ['required'],
            'address.city' => ['required'],
            'address.district' => ['required'],
            'address.street' => ['required'],
            'price' => ['required', 'decimal:0,2', 'min:1', 'max:2000'],
            'currency' => ['required', 'in:TWD,USD'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute is required.',
            'price.decimal'       => 'Price is invalid.',
            'price.min'           => 'Price is less than 0.',
            'price.max'           => 'Price is over 2000.',
            'currency.in'         => 'Currency format is wrong.',
        ];
    }
}
