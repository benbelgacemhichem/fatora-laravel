<?php

namespace Groupedesign\Fatora;

use Groupedesign\Fatora\Http\Middleware\CheckTransactionStatus;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class FatoraServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/fatora.php' => config_path('fatora.php'),
            __DIR__ . '/resources/error.blade.php' => resource_path('/views/payment/error.blade.php'),
            __DIR__ . '/resources/success.blade.php' => resource_path('/views/payment/success.blade.php'),
        ]);

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('checkTransactionStatus', CheckTransactionStatus::class);

    }

    public function register()
    {
    }
}