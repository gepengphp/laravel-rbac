<?php

namespace GepengPHP\LaravelRBAC\Http\Middleware;

use Closure;

class RBACAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // todo 添加 接口访问权限
        return $next($request);
    }
}
