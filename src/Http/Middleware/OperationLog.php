<?php

namespace GepengPHP\LaravelRBAC\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use GepengPHP\LaravelRBAC\Models\RBAC\OperationLog as OperationLogModel;

class OperationLog
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
        if ($this->shouldLogOperation($request)) {
            try {
                $operationLog = new OperationLogModel([
                    'user_id' => Auth::id(),
                    'path'    => substr($request->path(), 0, 255),
                    'method'  => $request->method(),
                    'ip'      => $request->getClientIp(),
                    'input'   => empty($request->input()) ? '' : \json_encode($request->input(), JSON_UNESCAPED_UNICODE),
                ]);
                $operationLog->save();
            } catch (\Exception $e) {
                // pass :)
            }
        }

        return $next($request);
    }

    private function shouldLogOperation($request)
    {
        return config('laravel-rbac.operation_log.enable')
            && !$this->inExceptArray($request)
            && Auth::user();
    }

    private function inExceptArray($request)
    {
        $excepts = (array) config('laravel-rbac.operation_log.except'); 
        foreach ($excepts as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            $methods = [];

            if (Str::contains($except, ':')) {
                list($methods, $except) = explode(':', $except);
                $methods = explode(',', $methods);
            }

            $methods = array_map('strtoupper', $methods);

            if ($request->is($except) &&
                (empty($methods) || in_array($request->method(), $methods))) {
                return true;
            }
        }

        return false;
    }
}
