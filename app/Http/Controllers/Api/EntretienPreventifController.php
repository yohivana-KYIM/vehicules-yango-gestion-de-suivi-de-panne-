<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EntretienPreventif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EntretienPreventifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entretiens = EntretienPreventif::with('intervention')->get();
        return response()->json($entretiens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'intervention_id' => 'required|exists:interventions,id',
            'date_planifiee' => 'nullable|date',
            'description' => 'nullable|string',
            'status' => 'nullable|in:planifie,en cours,termine,annule',
            'cout_estime' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $entretien = EntretienPreventif::create($request->all());
        return response()->json($entretien, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(EntretienPreventif $entretien)
    {
        $entretien->load('intervention');
        return response()->json($entretien);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntretienPreventif $entretien)
    {
        $validator = Validator::make($request->all(), [
            'intervention_id' => 'exists:interventions,id',
            'date_planifiee' => 'nullable|date',
            'description' => 'nullable|string',
            'status' => 'nullable|in:planifie,en cours,termine,annule',
            'cout_estime' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $entretien->update($request->all());
        return response()->json($entretien);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntretienPreventif $entretien)
    {
        $entretien->delete();
        return response()->json(null, 204);
    }
}
