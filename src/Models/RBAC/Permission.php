<?php

namespace GepengPHP\LaravelRBAC\Models\RBAC;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use GepengPHP\LaravelRBAC\Models\RBAC\Role;
use GepengPHP\LaravelRBAC\Models\RBAC\Menu;

class Permission extends Model
{
    const HTTP_METHODS = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'PATCH',
        'OPTIONS',
        'HEAD',
    ];

    protected $table = 'rbac_permissions';

    protected $fillable = [
        'name', 'slug', 'http_method', 'http_path',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'rbac_role_permissions', 'permission_id', 'role_id');
    }

    public function menus()
    {
        return $this->morphMany(Menu::class, 'permissible', null, 'slug', 'permission');
    }

    // todo bug 指定 setAttribute 后不更新这个字段
    public function setHttpMethodAttribute(array $httpMethods)
    {
        return \implode(',', $httpMethods);
    }

    public function getHttpMethodAttribute(?string $httpMethod): array
    {
        return $httpMethod ? \explode(',', $httpMethod) : [];
    }

    public function shouldPassThrough(\Illuminate\Http\Request $request): bool
    {
        if (empty($this->http_method) && empty($this->http_path)) {
            return true;
        }

        $method = $this->http_method;

        $matches = array_map(function ($path) use ($method) {
            $path = trim(config('laravel-rbac.routes.api_prefix'), '/').$path;

            if (Str::contains($path, ':')) {
                list($method, $path) = explode(':', $path);
                $method = explode(',', $method);
            }

            return compact('method', 'path');
        }, explode("\n", $this->http_path));

        foreach ($matches as $match) {
            if ($this->matchRequest($match, $request)) {
                return true;
            }
        }

        return false;
    }

    protected function matchRequest(array $match, Request $request): bool
    {
        if ($match['path'] == '/') {
            $path = '/';
        } else {
            $path = trim($match['path'], '/');
        }

        if (!$request->is($path)) {
            return false;
        }

        $method = collect($match['method'])->filter()->map(function ($method) {
            return strtoupper($method);
        });

        return $method->isEmpty() || $method->contains($request->method());
    }
}
