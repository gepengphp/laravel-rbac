<?php

namespace GepengPHP\LaravelRBAC\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
use GepengPHP\LaravelRBAC\Models\RBAC\Role;
use GepengPHP\LaravelRBAC\Models\RBAC\Permission;

class RBACAuth
{
    private $middlewarePrefix = 'rbac_auth';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
        $user        = User::with('roles', 'permissions')->find(Auth::id());
        $roles       = Role::with('permissions')->whereIn('id', $user->roles()->pluck('id'))->get();
        $permissions = $roles->pluck('permissions')->flatten()->merge($user->permissions);
        
        if ($this->checkRoutePermission($request)) {
            return $next($request);
        }

        if ($permissions->first(function ($permission) use ($request) {
            return $permission->shouldPassThrough($request);
        })) {
            return response()->fail(403, false, '没有权限');
        }
        dd($permissions);
        return $next($request);
    }

    private function checkRoutePermission($request): bool
    {
        if (!$middleware = collect($request->route()->middleware())->first(function ($middleware) {
            return Str::startsWith($middleware, $this->middlewarePrefix);
        })) {
            return false;
        }

        $args = explode(',', str_replace($this->middlewarePrefix, '', $middleware));
        $method = array_shift($args);

        if (!method_exists(Checker::class, $method)) {
            throw new \InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func_array([Checker::class, $method], [$args]);

        return true;
    }
}
