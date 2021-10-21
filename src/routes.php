<?php

$prefix = config('laravel-rbac.routes.api_prefix', 'api/');

Route::group(
    [
        'prefix' => $prefix,
        'namespace' => 'GepengPHP\LaravelRBAC\Http\Controllers',
        'middleware' => 'rbac_auth.api',
    ], 
    function () {
        // 权限
        Route::group(['prefix' => 'permissions'], function () {
            Route::get   ('all',      'PermissionController@all');
            Route::post  ('page',      'PermissionController@index');
            Route::post  ('',          'PermissionController@store');
            Route::get   ('{id}/view', 'PermissionController@view');
            Route::put   ('{id}',      'PermissionController@save');
            Route::delete('{id}',      'PermissionController@destory');
        });

        // 角色
        Route::group(['prefix' => 'roles'], function () {
            Route::get   ('all',       'RoleController@all');
            Route::post  ('page',      'RoleController@index');
            Route::post  ('',          'RoleController@store');
            Route::get   ('{id}/view', 'RoleController@view');
            Route::put   ('{id}',      'RoleController@save');
            Route::delete('{id}',      'RoleController@destory');
        });
    }
);
