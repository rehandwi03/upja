<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSBank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $bank = MSBank::orderBy('bank_name', 'ASC')->get();
        $respon = [
            "message" => "success",
            "data" => $bank
        ];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'bank_name' => 'required|string|max:50',
            'bank_image' => 'required|string|max:100',
        ]);

        try {
            $bank = MSBank::firstOrCreate([
                'bank_name' => $request->bank_name
            ], [
                'bank_image' => $request->bank_image,
                'bank_publish' => 0,
                'bank_hide' => 0
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
        return response()->json($respon, 201);
    }

    public function bank_publish(Request $request, $id)
    {
        $this->validate($request, [
            'bank_publish' => 'required|string|numeric'
        ]);

        $bank = MSBank::findOrFail($id);
        try {
            $bank->update([
                'bank_publish' => $request->bank_publish
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

    public function bank_hide(Request $request, $id)
    {
        $this->validate($request, [
            'bank_hide' => 'required|string|numeric'
        ]);

        $bank = MSBank::findOrFail($id);
        try {
            $bank->update(['bank_hide' => $request->bank_hide]);
        } catch (\Throwable $th) {
            $respon = ["message" => "error"];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }
}
