<?php

return [
    'routes' => [
        /*
         |--------------------------------------------------------------------------
         | RBAC 接口访问前缀，根据路由结构自行修改
         |--------------------------------------------------------------------------
         */
        'api_prefix' => 'api',

        /*
         |--------------------------------------------------------------------------
         | Laravel 鉴权中间件，默认 “auth”
         |--------------------------------------------------------------------------
         */
        // todo 用户认证，需要扩展，目前接口无法使用 laravel 自带的 auth，因为找不到 login 路由
        'auth_middleware' => 'jwt.auth',
    ],

    'requests' => [
        /*
         |--------------------------------------------------------------------------
         | RBAC 接口访问前缀，根据路由结构自行修改
         |--------------------------------------------------------------------------
         */
        'base_request' => null,
    ],

    'responses' => [
        /*
         |--------------------------------------------------------------------------
         | 处理【成功】消息的 Response 宏，默认 null，类型：闭包函数，例：
         | function (array $data = [], int $code = 200, string $msg = 'success') {
         |     return response()->success($data, $code, true, $msg);
         | }
         |--------------------------------------------------------------------------
         */
        'macro_success' => null,
        
        /*
         |--------------------------------------------------------------------------
         | 处理【失败】消息的 Response 宏，默认 null，类型：闭包函数，例：
         | function (int $code, string $msg, array $data = []) {
         |     return response()->fail($code, $msg, $data);
         | }
         |--------------------------------------------------------------------------
         */
        'macro_success' => null,
    ],

    'operation_log' => [
        /*
         |--------------------------------------------------------------------------
         | 是否记录接口访问行为日志
         |--------------------------------------------------------------------------
         */
        'enable' => true,

        /*
         |--------------------------------------------------------------------------
         | 不需要记录日志的 uri
         | All method to path like: admin/auth/logs
         | or specific method to path like: get:admin/auth/logs
         |--------------------------------------------------------------------------
         */
        'except' => [
            'api/operation-log/*',
            'api/auth-menu',
            'api/users/search'
        ],

        /*
         |--------------------------------------------------------------------------
         | 允许记录日志的方法
         | 默认选项：'GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'
         |--------------------------------------------------------------------------
         */
        'allowed_methods' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'],
    ],
];
