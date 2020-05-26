<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSVillage;
use Illuminate\Http\Request;

class VillageController extends Controller
{
    public function index()
    {
        $village = MSVillage::orderBy('village_name', 'ASC')->get();
        $respon = [
            "message" => "success",
            "data" => $village
        ];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_subdistrict' => 'required|string|numeric',
            'id_district' => 'required|string|numeric',
            'id_province' => 'required|string|numeric',
            'village_name' => 'required|string|max:100',
        ]);

        try {
            $village = MSVillage::firstOrCreate([
                'village_name' => $request->village_name,
            ], [
                'id_subdistrict' => $request->id_subdistrict,
                'id_district' => $request->id_district,
                'id_province' => $request->id_province,
                'village_hide' => 0
            ]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }

    public function village_hide(Request $request, $id)
    {
        $this->validate($request, [
            'village_hide' => 'required|string|numeric'
        ]);

        $village = MSVillage::findOrFail($id);

        try {
            $village->update([
                'village_hide' => $request->village_hide
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
            'id_subdistrict' => 'nullable|string|numeric',
            'id_district' => 'nullable|string|numeric',
            'id_province' => 'nullable|string|numeric',
            'village_name' => 'nullable|string|max:100',
        ]);

        $village = MSVillage::findOrFail($id);
        try {
            $village->update([
                'id_subdistrict' => $request->id_subdistrict,
                'id_district' => $request->id_district,
                'id_province' => $request->id_province,
                'village_name' => $request->village_name,
            ]);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }

        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }
}
