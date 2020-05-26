<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSSubdistrict;
use Illuminate\Http\Request;

class SubdistrictController extends Controller
{
    public function index()
    {
        $sub = MSSubdistrict::orderBy('subdistrict_name')->get();
        $respon = [
            "message" => "success",
            "data" => $sub
        ];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_district' => 'required|string|numeric',
            'id_province' => 'required|string|numeric',
            'subdistrict_name' => 'required|string|max:100'
        ]);
        try {
            $sub = MSSubdistrict::firstOrCreate([
                'subdistrict_name' => $request->subdistrict_name,
            ], [
                'id_district' => $request->id_district,
                'id_province' => $request->id_province,
                'subdistrict_hide' => 0
            ]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success"
        ];
        return response()->json($respon, 201);
    }

    public function subdistrict_hide(Request $request, $id)
    {
        $this->validate($request, [
            'subdistrict_hide' => 'required|string|numeric',
        ]);

        $sub = MSSubdistrict::findOrFail($id);
        try {
            $sub->update([
                'subdistrict_hide' => $request->subdistrict_hide
            ]);
        } catch (\Throwable $th) {
            $respon = [
                "message" => "error"
            ];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_district' => 'nullable|string|numeric',
            'id_province' => 'nullable|string|numeric',
            'subdistrict_name' => 'nullable|string|max:100'
        ]);

        $sub = MSSubdistrict::findOrFail($id);

        try {
            $sub->update([
                'subdistrict_name' => $request->subdistrict_name,
                'id_district' => $request->id_district,
                'id_province' => $request->id_province
            ]);
        } catch (\Throwable $th) {
            $respon = [
                "message" => "error"
            ];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }
}
