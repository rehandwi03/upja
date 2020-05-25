<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSProvince;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $province = MSProvince::orderBy('province_name', 'ASC')->get();
        $respon = [
            "message" => "success",
            "data" => $province
        ];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'province_name' => 'required|string|max:100',
        ]);

        $province = MSProvince::firstOrCreate([
            'province_name' => $request->province_name
        ], [
            'province_hide' => 0,
        ]);

        $respon = ["message" => "success"];
        return response()->json($respon, 201);
    }

    public function province_hide(Request $request, $id)
    {
        $this->validate($request, [
            'province_hide' => 'required|string'
        ]);

        $province = MSProvince::findOrFail($id);

        try {
            $province->update([
                'province_hide' => $request->province_hide
            ]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'province_name' => 'nullable|string|max:100',
        ]);

        $province = MSProvince::findOrFail($id);

        try {
            $province->update([
                'province_name' => $request->province_name
            ]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }
}
