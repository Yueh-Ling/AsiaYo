<?php

namespace App\Providers;

use App\Http\Transforms\TransformInterface;
use App\Http\Transforms\OrderTransform;
use App\Services\Interface\OrderServiceInterface;
use App\Services\OrderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
        $this->app->bind(TransformInterface::class, OrderTransform::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
