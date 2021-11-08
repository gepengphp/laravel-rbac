<?php

$prefix = config('laravel-rbac.routes.api_prefix', 'api');
$authMiddle = config('laravel-rbac.routes.auth_middleware', 'auth');

Route::group(
    [
        'prefix' => $prefix,
        'namespace' => 'GepengPHP\LaravelRBAC\Http\Controllers',
        'middleware' => [
            $authMiddle,
            'rbac_auth.api',
            'rbac.log',
        ],
    ], 
    function () {
        // 权限菜单
        Route::get('auth-menu', 'MenuController@authMenu');

        // 权限
        Route::group(['prefix' => 'permissions'], function () {
            Route::get   ('all',  'PermissionController@all');
            Route::post  ('page', 'PermissionController@index');
            Route::post  ('',     'PermissionController@store');
            Route::get   ('{id}', 'PermissionController@info')->where(['id' => '\d+']);
            Route::put   ('{id}', 'PermissionController@save')->where(['id' => '\d+']);
            Route::delete('{id}', 'PermissionController@destory')->where(['id' => '\d+']);
        });

        // 角色
        Route::group(['prefix' => 'roles'], function () {
            Route::get   ('all',  'RoleController@all');
            Route::post  ('page', 'RoleController@index');
            Route::post  ('',     'RoleController@store');
            Route::get   ('{id}', 'RoleController@info')->where(['id' => '\d+']);
            Route::put   ('{id}', 'RoleController@save')->where(['id' => '\d+']);
            Route::delete('{id}', 'RoleController@destory')->where(['id' => '\d+']);
        });

        // 用户
        Route::group(['prefix' => 'users'], function () {
            Route::post  ('page',   'UserController@index');
            Route::post  ('',       'UserController@store');
            Route::get   ('{id}',   'UserController@info')->where(['id' => '\d+']);
            Route::put   ('{id}',   'UserController@save')->where(['id' => '\d+']);
            Route::delete('{id}',   'UserController@destory')->where(['id' => '\d+']);
            Route::post  ('search', 'UserController@search');
        });

        // 菜单
        Route::group(['prefix' => 'menu'], function () {
            Route::get   ('tree',    'MenuController@tree');
            Route::post  ('reorder', 'MenuController@reorder');
            Route::post  ('page',    'MenuController@index');
            Route::post  ('',        'MenuController@store');
            Route::get   ('{id}',    'MenuController@info')->where(['id' => '\d+']);
            Route::put   ('{id}',    'MenuController@save')->where(['id' => '\d+']);
            Route::delete('{id}',    'MenuController@destory')->where(['id' => '\d+']);
        });

        // 行为日志
        Route::group(['prefix' => 'operation-log'], function () {
            Route::post('page', 'OperationLogController@index');
        });
    }
);
