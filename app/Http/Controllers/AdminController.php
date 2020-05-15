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
        // dd($request->all());
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
            'admin_password' => app('hash')->make($request->admin_password),
            'admin_fullname' => $request->admin_fullname,
            'admin_hide' => 0
        ]);
        return response()->json($admin, 201);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'id_admin' => 'required|string|numeric',
            'id_role' => 'required|string|numeric',
            'admin_username' => 'required|string',
            'admin_password' => 'nullable|string',
            'admin_fullname' => 'required|string'
        ]);

        $admin = MSAdmin::findOrFail($request->id_admin);
        $admin->update([
            'id_role' => $request->id_role,
            'admin_username' => $request->admin_username,
            'admin_password' => $request->admin_password,
            'admin_fullname' => $request->admin_fullname
        ]);
        return response()->json($admin, 200);
    }

    public function hide(Request $request)
    {
        $this->validate($request, [
            'id_admin' => 'required|string|numeric',
        ]);
        $admin = MSAdmin::findOrFail($request->id_admin);
        $admin->update([
            'admin_hide' => 1
        ]);
    }
}
