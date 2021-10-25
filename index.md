## Laravel RBAC

基于 laravel 6.x Auth 实现的 rbac 接口。

### 环境要求
php 7.2 +
laravel 6.x

### 安装

1. 安装 composer 扩展

```sh
composer require gepeng/laravel-rbac
```

2. 发布

此命令完成以下操作：
- 在 `config` 目录中生成名为 `laravel-rbac.php` 的配置文件。
- 在 `databases/migrations` 目录中创建数据库迁移文件。

```sh
php artisan vendor:publish --provider="GepengPHP\LaravelRBAC\LaravelRBACServiceProvider"
```

3. 编辑 `app/User.php` 用户模型文件，添加 trait 类扩展方法 `\GepengPHP\LaravelRBAC\Traits\ModelUser`

```php
class User extends Authenticatable implements JWTSubject
{
    // 扩展用户角色、权限等关联方法
    use Notifiable,
        \GepengPHP\LaravelRBAC\Traits\ModelUser;
        
    ...
}
```

4. 编辑 `config/app.config`，添加服务提供者 `GepengPHP\LaravelRBAC\LaravelRBACServiceProvider::class`

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

5. 迁移数据库文件

```sh
# 迁移数据库表结构
> php artisan migrate

# 创建填充数据
> php artisan db:seed --class="GepengPHP\LaravelRBAC\Seeds\TablesSeeder"
```

### 配置文件说明

- `routes`
  - `api_prefix` RBAC 接口访问前缀，默认值 “api”。根据路由结构自行修改
  - `auth_middleware` Laravel 鉴权中间件，默认 “jwt.auth”。
- `requests`
  - `base_request` 请求对象基类，默认值 “null”，根据路由结构自行修改
- `response`
  - `macro_success` 处理【成功】消息的 Response 宏，默认 null，类型：闭包函数，例：
    ```php
    function (array $data = [], int $code = 200, string $msg = 'success') {
        return response()->json([ 'code' => $code, 'msg' => $msg ]);
    }
    ```
  - `macro_success` 处理【失败】消息的 Response 宏，默认 null，类型：闭包函数，例：
    ```php
    function (int $code, string $msg, array $data = []) {
        return response()->json([ 'code' => $code, 'msg' => $msg, 'data' => $data ]);
    }
    ```

### 接口文档

- 权限
  - 详情
  - 全部列表
  - 分页列表
  - 创建
  - 修改
  - 删除
- 角色
- 用户
- 菜单

