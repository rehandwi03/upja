<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UpjaUom;
use Illuminate\Http\Request;

class UpjaUomController extends Controller
{
    public function index()
    {
        try {
            $uom = UpjaUom::orderBy('uom_name', 'ASC')->get();
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
        return response()->json([
            "message" => "success",
            "data" => $uom
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_upja' => 'required|numeric',
            'uom_name' => 'required|string',
            'uom_desc' => 'required|string'
        ]);

        try {
            $uom = UpjaUom::firstOrCreate([
                'uom_name' => $request->uom_name
            ], [
                'id_upja' => $request->id_upja,
                'uom_desc' => $request->uom_desc,
                'uom_hide' => 0
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
        return response()->json(["message" => "success"], 201);
    }

    public function uom_hide(Request $request, $id)
    {
        $this->validate($request, [
            'uom_hide' => 'required|numeric'
        ]);

        try {
            $uom = UpjaUom::findOrFail($id);
            $uom->update([
                'uom_hide' => $request->uom_hide
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
        return response()->json([
            "message" => "success"
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_upja' => 'nullable|numeric',
            'uom_name' => 'nullable|string',
            'uom_desc' => 'nullable|string'
        ]);
        try {
            $uom = UpjaUom::findOrFail($id);
            $uom->update([
                'id_upja' => $request->id_upja,
                'uom_desc' => $request->uom_desc,
                'uom_name' => $request->uom_name
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
        return response()->json([
            "message" => "success"
        ], 200);
    }
}
