<?php

namespace Eozden\ApiResponse;

use Illuminate\Routing\Router;
use Eozden\ApiResponse\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Eozden\ApiResponse\Http\Middleware\JsonMiddleware;

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

        if(config('api-response.force', true)) {
            $router = $this->app->make(Router::class);
            $router->pushMiddlewareToGroup('api', JsonMiddleware::class);
        }
    }
}
