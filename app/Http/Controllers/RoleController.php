<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = MSRole::all();
        return response()->json($role, 200);
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $this->validate($request, [
            'role_name' => 'required|string',
            'role_desc' => 'required|string',
        ]);
        $role = MSRole::firstOrCreate(
            [
                'role_name' => $request->role_name
            ],
            [
                'role_desc' => $request->role_desc,
            ]
        );
        return response()->json($role, 201);
    }

    public function update(Request $request, $id)
    {
        $role = MSRole::findOrFail($id);
        // dd($request);
        $role->update([
            'role_name' => $request->role_name,
            'role_desc' => $request->role_desc
        ]);
        return response()->json($role, 200);
    }

    public function destroy($id)
    {
        $role = MSRole::findOrFail($id);
        $role->delete();
        $data = [
            "message" => "deleted"
        ];
        return response()->json($data, 204);
    }
}
