<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();
        // $credentials = JWT::decode($token, env('APP_KEY'), ['HS256']);
        // dd($credentials);
        if (!$token) {
            // Unauthorized response if token not there
            return [
                'code' => 401,
                'error' => 'Token not provided.'
            ];
        }
        try {
            $credentials = JWT::decode($token, env('APP_KEY'), ['HS256']);
        } catch (ExpiredException $e) {
            return [
                'code' => 400,
                'error' => 'Provided token is expired.'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 400,
                'error' => 'An error while decoding token.'
            ];
        }
        // $request->request->add(['auth' => ['id' => $credentials->id]]);
        $request->request->add([
            'id' => $credentials->id,
            'role_name' => "anjay"
        ]);
        return $next($request);
    }
}
