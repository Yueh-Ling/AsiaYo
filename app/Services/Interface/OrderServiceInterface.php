<?php

namespace App\Services\Interface;

interface OrderServiceInterface
{
    public function calculateTWDPrice(array $data): int;
}
