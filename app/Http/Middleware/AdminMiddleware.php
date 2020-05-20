<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        // Pre-Middleware Action
        $role = $request->role_name;
        if (!$role) {
            return [
                'code' => 401,
                'error' => 'Role not provided.'
            ];
        } elseif ($role == "admin") {
            return $next($request);
        } else {
            return [
                'code' => 400,
                'error' => 'Unauthorized'
            ];
        }
    }
}
