<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSTrans;
use Illuminate\Http\Request;

class TransController extends Controller
{
    public function index()
    {
        try {
            $trans = MSTrans::orderBy('trans_code', 'ASC')->get();
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success", "data" => $trans];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_upja' => 'required|numeric',
            'id_farmer' => 'required|numeric',
            'id_faddress' => 'required|numeric',
            'id_ubank' => 'required|numeric',
            'trans_code' => 'required|string|max:50',
            'trans_payment' => 'required|string'
        ]);

        try {
            $trans = MSTrans::firstOrCreate([
                'id_ubank' => $request->id_ubank
            ], [
                'id_upja' => $request->id_upja,
                'id_farmer' => $request->id_farmer,
                'id_faddress' => $request->id_faddress,
                'trans_code' => $request->trans_code,
                'trans_type' => "tillage",
                'trans_payment' => $request->trans_payment,
                'trans_status' => "pending"
            ]);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 201);
    }

    public function trans_status(Request $request, $id)
    {
        $this->validate($request, [
            'trans_status' => 'required|string'
        ]);

        try {
            $trans = MSTrans::findOrFail($id);
            $trans->update([
                'trans_status' => $request->trans_status
            ]);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($request, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }
}
