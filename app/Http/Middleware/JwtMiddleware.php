<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    // public function handle($request, Closure $next, $guard = null)
    // {
    //     $token = $request->header('Authorization');
    //     if (!$token) {
    //         // Unauthorized response if token not there
    //         return response()->json([
    //             'error' => 'Token not provided.'
    //         ], 401);
    //     }
    //     try {
    //         $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
    //     } catch (ExpiredException $e) {
    //         return response()->json([
    //             'error' => 'Provided token is expired.'
    //         ], 400);
    //     } catch (Exception $e) {
    //         return response()->json([
    //             'error' => 'An error while decoding token.'
    //         ], 400);
    //     }
    //     $user = User::find($credentials->sub);
    //     // Now let's put the user in the request class so that you can grab it from there
    //     $request->auth = $user;
    //     return $next($request);
    // }
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
        $request->request->add(['auth' => ['id' => $credentials->id]]);
        return $next($request);
    }
}
