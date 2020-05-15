<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSAdmin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admin = MSAdmin::orderBy('admin_fullname', 'ASC')->get();
        return response()->json($admin, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_role' => 'required|string|numeric',
            'admin_username' => 'required|string',
            'admin_password' => 'required|string',
            'admin_fullname' => 'required|string'
        ]);

        $admin = MSAdmin::firstOrCreate([
            'admin_username' => $request->admin_username
        ], [
            'id_role' => $request->id_role,
            'admin_password' => $request->admin_password,
            'admin_fullname' => $request->admin_fullname,
            'admin_hide' => 0
        ]);
        return response()->json($admin, 201);
    }
}
