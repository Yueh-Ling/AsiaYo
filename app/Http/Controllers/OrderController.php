<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Transforms\TransformInterface;
use App\Services\Interface\OrderServiceInterface;

class OrderController extends Controller
{
    private $orderService;
    private $orderTransform;

    public function __construct(OrderServiceInterface $orderService, TransformInterface $orderTransform)
    {
        $this->orderService = $orderService;
        $this->orderTransform = $orderTransform;
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();
        $twd_price = $this->orderService->calculateTWDPrice($validated);
        $result = $this->orderTransform->transform($validated, $twd_price);
        return response()->json($result, 200);
    }
}
