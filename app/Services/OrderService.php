<?php

namespace App\Services;

use App\Services\Interface\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{
    public function calculateTWDPrice(array $data): int
    {
        $price = $data['price'];
        if ($data['currency'] === 'USD') {
            $price = ceil($price * 31);
        }
        return $price;
    }
}
