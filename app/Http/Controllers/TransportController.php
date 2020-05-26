<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\MSTransport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        try {
            $transport = MSTransport::orderBy('transport_name', 'ASC')->get();
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "succes", "data" => $transport];
        return response()->json($respon, 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'transport_name' => 'required|string|max:30',
            'transport_desc' => 'required|string',
            'transport_default_price' => 'required|numeric',
        ]);

        try {
            $transport = MSTransport::firstOrCreate([
                'transport_name' => $request->transport_name
            ], [
                'transport_desc' => $request->transport_desc,
                'transport_default_price' => $request->transport_default_price,
                'transport_hide' => 0
            ]);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 201);
    }

    public function transport_hide(Request $request, $id)
    {
        $this->validate($request, [
            'transport_hide' => 'required|numeric'
        ]);

        try {
            $transport = MSTransport::findOrFail($id);
            $transport->update([
                'transport_hide' => $request->transport_hide
            ]);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }
        $respon = [
            "message" => "success",
        ];
        return response()->json($respon, 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'transport_name' => 'required|string|max:30',
            'transport_desc' => 'required|string',
            'transport_default_price' => 'required|string|numeric|max:10',
        ]);

        try {
            $transport = MSTransport::findOrFail($id);
            $transport->update([
                'transport_name' => $request->transport_name,
                'transport_desc' => $request->transport_desc,
                'transport_default_price' => $request->transport_default_price
            ]);
        } catch (\Exception $e) {
            $respon = ["message" => $e->getMessage()];
            return response()->json($respon, 400);
        }
        $respon = ["message" => "success"];
        return response()->json($respon, 200);
    }
}
