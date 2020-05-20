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
            'farmer_status' => 'inactive',
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
}