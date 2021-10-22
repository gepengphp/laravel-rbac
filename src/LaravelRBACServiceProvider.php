<?php

namespace GepengPHP\LaravelRBAC;

use Illuminate\Support\ServiceProvider;

class LaravelRBACServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/laravel-rbac.php', 'laravel-rbac');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布
        $this->publishes([
            __DIR__.'/config/laravel-rbac.php' => config_path('laravel-rbac.php'),
        ]);
        
        // route
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        // migration
        $this->loadMigrationsFrom(__DIR__.'/databases/migrations');

        // register controllers
        $this->app->make('GepengPHP\LaravelRBAC\Http\Controllers\PermissionController');
        $this->app->make('GepengPHP\LaravelRBAC\Http\Controllers\RoleController');

        // register middleware
        $this->addMiddlewareAlias('rbac_auth.api', \GepengPHP\LaravelRBAC\Http\Middleware\RBACAuth::class);
    }

    protected function addMiddlewareAlias($name, $class)
    {
        $router = $this->app['router'];

        if (method_exists($router, 'aliasMiddleware')) {
            return $router->aliasMiddleware($name, $class);
        }

        return $router->middleware($name, $class);
    }
}
