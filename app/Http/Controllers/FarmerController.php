<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSFarmer;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index()
    {
        $farmer = MSFarmer::orderBy('id_farmer', 'ASC')->get();
        $data = [
            "message" => "success",
            "data" => $farmer
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'farmer_id' => 'required|string',
            'farmer_phone' => 'required|string|numeric',
            'farmer_email' => 'nullable|email|unique:ms_farmer',
            'farmer_fullname' => 'required|string',
            'farmer_password' => 'required|string',
        ]);
        $farmer = MSFarmer::firstOrCreate([
            'farmer_phone' => $request->farmer_phone,
        ], [
            'farmer_id' => $request->farmer_id,
            'farmer_fullname' => $request->farmer_fullname,
            'farmer_password' =>  app('hash')->make($request->farmer_password),
            'farmer_status' => $request->farmer_status,
            'farmer_verified' => 0,
            'farmer_verify_code' => 0,
            'farmer_hide' => 0,
        ]);
        $data = [
            "message" => "success",
            "data" => $farmer
        ];
        return response()->json($data, 201);
    }

    public function farmer_status(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'farmer_status' => 'required|string'
        ]);
        $farmer = MSFarmer::findOrFail($id);
        try {
            $farmer->update([
                'farmer_status' => $request->farmer_status
            ]);
        } catch (\Exception $e) {
            $respon = [
                "message" => "can't change status"
            ];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 200);
    }

    public function farmer_hide(Request $request, $id)
    {
        $this->validate($request, [
            'farmer_hide' => 'required|string|numeric'
        ]);

        $farmer = MSFarmer::findOrFail($id);
        try {
            $farmer->update([
                'farmer_hide' => $request->farmer_hide
            ]);
        } catch (\Exception $e) {
            $respon = [
                "message" => "can't change hide code"
            ];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 200);
    }

    public function verify_code(Request $request, $id)
    {
        $this->validate($request, [
            'farmer_verify_code' => 'required|string'
        ]);

        $farmer = MSFarmer::findOrFail($id);
        try {
            $farmer->update([
                'farmer_verify_code' => $request->farmer_verify_code
            ]);
        } catch (\Exception $e) {
            $respon = [
                "message" => "can't change verify code"
            ];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 200);
    }
}
