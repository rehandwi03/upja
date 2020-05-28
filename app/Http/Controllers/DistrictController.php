<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSDistrict;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $district = MSDistrict::orderBy('district_name', 'ASC')->get();
        $respon = [
            "message" => "success",
            "data" => $district
        ];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_province' => 'required|string|numeric',
            'district_name' => 'required|string',
        ]);

        try {
            $district = MSDistrict::firstOrCreate([
                'district_name' => $request->district_name
            ], [
                'id_province' => $request->id_province,
                'district_hide' => 0
            ]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }

    public function district_hide(Request $request, $id)
    {
        $this->validate($request, [
            'district_hide' => 'required|string|numeric'
        ]);

        $district = MSDistrict::findOrFail($id);

        try {
            $district->update([
                'district_hide' => $request->district_hide
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
            'district_name' => 'nullable|string',
            'id_province' => 'nullable|string'
        ]);

        $district = MSDistrict::findOrFail($id);

        try {
            $district->update([
                'id_province' => $request->id_province,
                'district_name' => $request->district_name
            ]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }
}
