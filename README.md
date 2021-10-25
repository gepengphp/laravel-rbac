# laravel-rbac
基于 Laravel 6，RBAC 的权限控制接口

## 安装

1. 发布配置文件，执行以下命令：

```sh
php artisan vendor:publish --provider="GepengPHP\LaravelRBAC\LaravelRBACServiceProvider"
```

此命令完成以下操作：
- 在 `config` 目录中生成名为 `laravel-rbac.php` 的配置文件。
- 在 `databases/migrations` 目录中创建数据库迁移文件。

配置说明：
```php
<?php

return [
    'routes' => [
        /*
         * RBAC 接口访问前缀，根据路由结构自行修改
         */
        'api_prefix' => 'api',

        /*
         * Laravel 鉴权中间件，默认 “jwt.auth”
         */
        'auth_middleware' => 'jwt.auth',
    ],

    'requests' => [
        /*
         * 请求对象基类，根据路由结构自行修改
         */
        'base_request' => null,
    ],

    'responses' => [
        /*
         * 处理【成功】消息的 Response 宏，默认 null，类型：闭包函数，例：
         * function (array $data = [], int $code = 200, string $msg = 'success') {
         *     return response()->json([ 'code' => $code, 'msg' => $msg ]);
         * }
         */
        'macro_success' => null,
        
        /*
         * 处理【失败】消息的 Response 宏，默认 null，类型：闭包函数，例：
         * function (int $code, string $msg, array $data = []) {
         *     return response()->json([ 'code' => $code, 'msg' => $msg, 'data' => $data ]);
         * }
         */
        'macro_success' => null,
    ],
];
```

2. 编辑 `/app/User.php` 用户模型文件，添加 trait 类扩展方法 `\GepengPHP\LaravelRBAC\Traits\ModelUser`，例：

```php
class User extends Authenticatable implements JWTSubject
{
    // 扩展用户角色、权限等关联方法
    use Notifiable,
        \GepengPHP\LaravelRBAC\Traits\ModelUser;
}
```

3. 编辑 `config/app.config`，添加服务提供者 `GepengPHP\LaravelRBAC\LaravelRBACServiceProvider::class`，例：

```php
return [

    ...

    'providers' => [

        ...

        // Laravel RBAC
        GepengPHP\LaravelRBAC\LaravelRBACServiceProvider::class,
    ],

    ...

];
```

4. 迁移数据库文件。

```sh
# 迁移数据库表结构
> php artisan migrate

# 创建填充数据
> php artisan db:seed --class="GepengPHP\LaravelRBAC\Seeds\TablesSeeder"
```

