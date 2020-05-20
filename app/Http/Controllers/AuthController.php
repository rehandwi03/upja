<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSAdmin;
use App\MSFarmer;
use App\MSUpja;
use App\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'nullable|string',
            'password' => 'required|string',
            'farmer_phone' => 'nullable|string',
            'upja_phone' => 'nullable|string'
        ]);

        if ($request->has('farmer_phone')) {
            return $this->login_farmer($request->farmer_phone, $request->password);
        }
        if ($request->has('username')) {
            return $this->login_admin($request->username, $request->password);
        }
        if ($request->has('upja_phone')) {
            return $this->login_upja($request->upja_phone, $request->password);
        }
    }

    public function logout()
    {
        dd(JWT::getToken());
    }

    private function login_admin($username, $password)
    {
        $admin = MSAdmin::with('role')->where('admin_username', '=', $username)->first();
        if (!$admin) {
            $response = [
                "message" => "login_failed",
                "result" => [
                    "token" => null
                ]
            ];
            return response()->json($response, 401);
        }
        if (Hash::check($password, $admin->admin_password)) {
            $payload = [
                'iss' => "lumen-jwt", // Issuer of the token
                'id' => $admin->id_admin, // Subject of the token
                'role' => $admin->role->role_name,
                'iat' => time(), // Time when JWT was issued. 
                'exp' => time() + 60 * 60 // Expiration time
            ];
            $respon = [
                "message" => "login_success",
                "result" => [
                    "token" => JWT::encode($payload, env('APP_KEY'))
                ]
            ];
            return response()->json($respon, 200);
        } else {
            $respon = [
                "message" => "login_failed",
                "result" => [
                    "token" => null
                ]
            ];
            return response()->json($respon, 401);
        }
    }

    private function login_upja($phone, $password)
    {
        $upja = MSUpja::where('upja_phone', '=', $phone)->first();
        if (!$upja) {
            $response = [
                "message" => "login_failed",
                "result" => [
                    "token" => null
                ]
            ];
            return response()->json($response, 401);
        }
        if (Hash::check($password, $upja->upja_password)) {
            $payload = [
                'iss' => "lumen-jwt", // Issuer of the token
                'id' => $upja->id_admin, // Subject of the token
                'iat' => time(), // Time when JWT was issued. 
                'exp' => time() + 60 * 60 // Expiration time
            ];
            $respon = [
                "message" => "login_success",
                "result" => [
                    "token" => JWT::encode($payload, env('APP_KEY'))
                ]
            ];
            return response()->json($respon, 200);
        } else {
            $respon = [
                "message" => "login_failed",
                "result" => [
                    "token" => null
                ]
            ];
            return response()->json($respon, 401);
        }
    }

    private function login_farmer($phone, $password)
    {
        $farmer = MSFarmer::where('farmer_phone', '=', $phone)->first();
        if (!$farmer) {
            $response = [
                "message" => "login_failed",
                "result" => [
                    "token" => null
                ]
            ];
            return response()->json($response, 401);
        }
        if (Hash::check($password, $farmer->farmer_password)) {
            $payload = [
                'iss' => "lumen-jwt", // Issuer of the token
                'id' => $farmer->id_farmer, // Subject of the token
                'iat' => time(), // Time when JWT was issued. 
                'exp' => time() + 60 * 60 // Expiration time
            ];
            $respon = [
                "message" => "login_success",
                "result" => [
                    "token" => JWT::encode($payload, env('APP_KEY'))
                ]
            ];
            return response()->json($respon, 200);
        } else {
            $respon = [
                "message" => "login_failed",
                "result" => [
                    "token" => null
                ]
            ];
            return response()->json($respon, 401);
        }
    }
}
