<?php

use App\Services\OrderService;

beforeEach(function () {
    $this->orderService = new OrderService();
});

test('if the currency is USD, the price should be multiplied by 31', function () {
    $data = [
        'price' => 100,
        'currency' => 'USD',
    ];
    expect($this->orderService->calculateTWDPrice($data))->toBe(3100);
});

test('if the currency is TWD, the price should be the same', function () {
    $data = [
        'price' => 100,
        'currency' => 'TWD',
    ];
    expect($this->orderService->calculateTWDPrice($data))->toBe(100);
});

test('if the currency is USD, the TWD price should be integer', function () {
    $data = [
        'price' => 100.31,
        'currency' => 'USD',
    ];
    expect($this->orderService->calculateTWDPrice($data))->toBe(3110);
});
