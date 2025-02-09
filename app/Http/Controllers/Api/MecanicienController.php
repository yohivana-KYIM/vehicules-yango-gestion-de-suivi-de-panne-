<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mecanicien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MecanicienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mecaniciens = Mecanicien::with('user', 'interventions')->get();
        return response()->json($mecaniciens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mecanicien = Mecanicien::create($request->all());
        return response()->json($mecanicien, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mecanicien $mecanicien)
    {
        $mecanicien->load('user', 'interventions');
        return response()->json($mecanicien);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mecanicien $mecanicien)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $mecanicien->update($request->all());
        return response()->json($mecanicien);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mecanicien $mecanicien)
    {
        $mecanicien->delete();
        return response()->json(null, 204);
    }
}