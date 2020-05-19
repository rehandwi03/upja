<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('id', 'ASC')->get();
        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
            'id_role' => 'required|string|numeric'
        ]);
        $user = User::firstOrCreate([
            'username' => $request->username
        ], [
            'password' => app('hash')->make($request->password),
            'id_role' => $request->id_role
        ]);
        $data = [
            "message" => "Success",
        ];
        return response()->json($data, 201);
    }
}
