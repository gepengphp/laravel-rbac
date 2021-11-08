<?php

namespace GepengPHP\LaravelRBAC;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use GepengPHP\LaravelRBAC\Exceptions\RBACException;

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
        $this->registerPublishing();
        
        // route
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');

        // register controllers
        $this->app->make('GepengPHP\LaravelRBAC\Http\Controllers\PermissionController');
        $this->app->make('GepengPHP\LaravelRBAC\Http\Controllers\RoleController');

        // register middleware
        $this->addMiddlewareAlias('rbac_auth.api', \GepengPHP\LaravelRBAC\Http\Middleware\RBACAuth::class);
        $this->addMiddlewareAlias('rbac.log', \GepengPHP\LaravelRBAC\Http\Middleware\OperationLog::class);

        $this->macroResponse();
        $this->validatorExtends();
    }

    /**
     * 添加 response 宏
     */
    private function macroResponse()
    {
        // 失败
        Response::macro('RBACfail', function (int $code, string $msg, array $data = []) {
            $macroFail = config('laravel-rbac.responses.macro_fail') ?? null;
            if (!empty($macroFail)) {
                if (!($macroFail instanceof \Closure)) {
                    throw new RBACException(500, '相应宏配置错误');
                }
                return $macroFail($code, $msg, $data);
            }

            $responseData = [
                'code' => $code,
                'msg'  => $msg,
                'data' => (object) $data,
            ];

            return Response::json($responseData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        });

        // 成功
        Response::macro('RBACSuccess', function (array $data = [], int $code = 200, string $msg = 'success') {
            $macroSuccess = config('laravel-rbac.responses.macro_success') ?? null;
            if (!empty($macroSuccess)) {
                if (!($macroSuccess instanceof \Closure)) {
                    throw new RBACException(500, '相应宏配置错误');
                }
                return $macroSuccess($data, $code, $msg);
            }

            $responseData = [
                'code' => $code,
                'msg'  => $msg,
                'data' => (object) $data,
            ];

            return Response::json($responseData)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        });
    }

    /**
     * 添加验证规则
     */
    private function validatorExtends()
    {
        Validator::extend(
            'ExitsOrZero',
            function ($attribute, $value, $parameters, $validator) {
                if (0 === $value) {
                    return true;
                }

                $validator = Validator::make(
                    [$attribute => $value],
                    [$attribute => 'exists:' . $parameters[0] . ',' . $parameters[1]]
                );
                return !$validator->fails();
            },
            '选定的 :attribute 是无效的'
        );

        Validator::extend(
            'arrayInArray',
            function ($attribute, $value, $parameters, $validator) {
                if (!\is_array($value)) {
                    return false;
                }

                foreach ($value as $i => $v) {
                    if (!in_array($v, $parameters)) {
                        return false;
                    }
                }

                return true;
            },
            '选定的 :attribute 是无效的'
        );
    }

    protected function addMiddlewareAlias($name, $class)
    {
        $router = $this->app['router'];

        if (method_exists($router, 'aliasMiddleware')) {
            return $router->aliasMiddleware($name, $class);
        }

        return $router->middleware($name, $class);
    }

    /**
     * 发布
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            // 路由
            $this->publishes([__DIR__.'/config/laravel-rbac.php' => config_path('laravel-rbac.php')]);
            // 数据库表
            $this->publishes([__DIR__.'/databases/migrations' => database_path('migrations')], 'laravel-rbac-migrations');
        }
    }
}
