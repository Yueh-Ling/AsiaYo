<?php

use App\Http\Transforms\OrderTransform;

beforeEach(function () {
    $this->orderTransform = new OrderTransform();
});

test('transform the data to the TWD', function () {
    $data = [
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road',
        ],
        'price' => 100,
        'currency' => 'USD',
    ];

    expect($this->orderTransform->transform($data, 3100))->toBe([
        'id' => 'A0000001',
        'name' => 'Melody Holiday Inn',
        'address' => [
            'city' => 'taipei-city',
            'district' => 'da-an-district',
            'street' => 'fuxing-south-road',
        ],
        'price' => 3100,
        'currency' => 'TWD',
    ]);
});
