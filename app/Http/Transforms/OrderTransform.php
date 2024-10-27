<?php

namespace App\Http\Transforms;

use App\Http\Transforms\TransformInterface;

class OrderTransform implements TransformInterface
{
    public function transform($order, $twd_price)
    {
        return [
            'id' => $order['id'],
            'name' => $order['name'],
            'address' => $order['address'],
            'price' => $twd_price,
            'currency' => 'TWD',
        ];
    }
}
