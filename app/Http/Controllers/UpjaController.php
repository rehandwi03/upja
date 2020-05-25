<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSUpja;
use Illuminate\Http\Request;

class UpjaController extends Controller
{
    public function index()
    {
        $upja = MSUpja::orderBy('upja_id', 'ASC')->get();
        $data = [
            "message" => "success",
            "data" => $upja
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_province' => 'required|string|numeric',
            'id_district' => 'required|string|numeric',
            'id_subdistrict' => 'required|string|numeric',
            'id_village' => 'required|string|numeric',
            'id_role' => 'required|string|numeric',
            'upja_id' => 'required|string|max:10',
            'upja_fullname' => 'required|string|max:100',
            'upja_email' => 'required|string|max:50',
            'upja_phone' => 'required|string|max:15',
            'upja_password' => 'required|string',
            'upja_emergency_phone' => 'nullable|string|max:15',
            'upja_image' => 'required|string|max:100',
            'upja_path' => 'required|string|max:50',
            'upja_address' => 'required|string',
            'upja_lat' => 'required|string|max:20',
            'upja_long' => 'required|string|max:20',
        ]);

        try {
            $upja = MSUpja::firstOrCreate([
                'upja_id' => $request->upja_id
            ], [
                'id_province' => $request->id_province,
                'id_district' => $request->id_district,
                'id_subdistrict' => $request->id_subdistrict,
                'id_village' => $request->id_village,
                'id_role' => $request->id_role,
                'upja_fullname' => $request->upja_fullname,
                'upja_email' => $request->upja_email,
                'upja_phone' => $request->upja_phone,
                'upja_password' => $request->upja_password,
                'upja_emergency_phone' => $request->upja_emergency_phone,
                'upja_image' => $request->upja_image,
                'upja_path' => $request->upja_path,
                'upja_address' => $request->upja_address,
                'upja_lat' => $request->upja_lat,
                'upja_long' => $request->upja_long,
                'upja_status' => 'inactive',
                'upja_verified' => 0,
                'upja_hide' => 0,
            ]);
        } catch (\Exception $e) {
            $respon = [
                "message" => "error",
            ];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 201);
    }

    public function upja_status(Request $request, $id)
    {
        $upja = MSUpja::findOrFail($id);
        try {
            $upja->update([
                'upja_status' => $request->upja_status
            ]);
        } catch (\Throwable $th) {
            $respon = [
                "message" => "error"
            ];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 200);
    }

    public function upja_verified(Request $request, $id)
    {
        $upja = MSUpja::findOrFail($id);
        try {
            $upja->update([
                'upja_verified' => $request->upja_verified
            ]);
        } catch (\Throwable $th) {
            $respon = [
                "message" => "error"
            ];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 200);
    }

    public function upja_hide(Request $request, $id)
    {
        $upja = MSUpja::findOrFail($id);
        try {
            $upja->update([
                'upja_hide' => $request->upja_hide
            ]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 200);
    }
}
