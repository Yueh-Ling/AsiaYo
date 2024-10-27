<?php

namespace App\Http\Transforms;

interface TransformInterface
{
    public function transform(array $order, int $twd_price);
}
