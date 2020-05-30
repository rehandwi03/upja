<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\TransJourney;
use Illuminate\Http\Request;

class TransJourneyController extends Controller
{
    public function index()
    {
        try {
            $tj = TransJourney::orderBy('tjourney_author_id', 'ASC')->get();
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
        return response()->json([
            "message" => "success",
            "data" => $tj
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_trans' => 'required|numeric',
            'tjourney_author_id' => 'required|numeric',
            'tjourney_author' => 'required|string',
            'tjourney_status' => 'required|string',
            'tjourney_content' => 'required|string',
        ]);

        try {
            $tj = TransJourney::create([
                'id_trans' => $request->id_trans,
                'tjourney_author_id' => $request->tjourney_author_id,
                'tjourney_author' => $request->tjourney_author,
                'tjourney_status' => $request->tjourney_status,
                'tjourney_content' => $request->tjourney_content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 400);
        }
        return response()->json([
            "message" => "success",
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_trans' => 'nullable|numeric',
            'tjourney_author_id' => 'nullable|numeric',
            'tjourney_author' => 'nullable|string',
            'tjourney_status' => 'nullable|string',
            'tjourney_content' => 'nullable|string',
        ]);

        try {
            $tj = TransJourney::findOrFail($id);
            $tj->update([
                'id_trans' => $request->id_trans,
                'tjourney_author_id' => $request->tjourney_author_id,
                'tjourney_author' => $request->tjourney_author,
                'tjourney_status' => $request->tjourney_status,
                'tjourney_content' => $request->tjourney_content,
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
