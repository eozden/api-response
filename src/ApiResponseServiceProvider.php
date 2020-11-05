<?php

namespace Eozden\ApiResponse;

use Eozden\ApiResponse\Http\Middleware\JsonMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ApiResponseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'api-response');
    }

    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'api-response');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('api-response.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/api-response'),
            ], 'resources');
        }

        Response::macro('ok', function ($data = null, int $code = null) {
            return Builder::ok($data, $code);
        });

        Response::macro('error', function ($data = null, int $code = null) {
            return Builder::error($data, $code);
        });

        if (config('api-response.force', true)) {
            $router = $this->app->make(Router::class);
            $router->pushMiddlewareToGroup('api', JsonMiddleware::class);
        }
    }
}
