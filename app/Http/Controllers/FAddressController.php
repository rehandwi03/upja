<?php

namespace App\Http\Controllers;

use App\FarmerAddress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FAddressController extends Controller
{
    public function index()
    {
        try {
            $address = FarmerAddress::orderBy('faddress_name', 'ASC')->get();
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
        }
        $respon = ["message" => "succes", "data" => $address];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_farmer' => 'required|string|numeric',
            'id_province' => 'required|string|numeric',
            'id_district' => 'required|string|numeric',
            'id_subdistrict' => 'required|string|numeric',
            'id_village' => 'required|string|numeric',
            'faddress_name' => 'required|string|max:100',
            'faddress_desc' => 'required|string',
            'faddress_long' => 'required|string',
            'faddress_lat' => 'required|string'
        ]);

        try {
            $address = FarmerAddress::firstOrCreate([
                'faddress_name' => $request->faddress_name
            ], [
                'id_farmer' => $request->id_farmer,
                'id_province' => $request->id_province,
                'id_district' => $request->id_district,
                'id_subdistrict' => $request->id_subdistrict,
                'id_village' => $request->id_village,
                'faddress_name' => $request->faddress_name,
                'faddress_desc' => $request->faddress_desc,
                'faddress_long' => $request->faddress_long,
                'faddress_lat' => $request->faddress_lat,
            ]);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 201);
    }

    public function id_farmer($id)
    {
        try {
            $addres = FarmerAddress::findOrFail($id);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success",
            "data" => $addres
        ];
        return response()->json($respon, 200);
    }
}
