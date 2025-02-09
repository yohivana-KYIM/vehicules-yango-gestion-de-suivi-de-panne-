<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $interventions = Intervention::with('vehicule', 'mecanicien', 'piecesUtilisees', 'entretienPreventif')->get();
        return response()->json($interventions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nature_intervention' => 'required|string|max:255',
            'duree_intervention' => 'required|integer',
            'date_debut_intervention' => 'required|date',
            'vehicule_id' => 'required|exists:vehicules,id',
            'mecanicien_id' => 'required|exists:mecaniciens,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $intervention = Intervention::create($request->all());
        return response()->json($intervention, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Intervention $intervention)
    {
        $intervention->load('vehicule', 'mecanicien', 'piecesUtilisees', 'entretienPreventif');
        return response()->json($intervention);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Intervention $intervention)
    {
        $validator = Validator::make($request->all(), [
            'nature_intervention' => 'string|max:255',
            'duree_intervention' => 'integer',
            'date_debut_intervention' => 'date',
            'vehicule_id' => 'exists:vehicules,id',
            'mecanicien_id' => 'exists:mecaniciens,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $intervention->update($request->all());
        return response()->json($intervention);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Intervention $intervention)
    {
        $intervention->delete();
        return response()->json(null, 204);
    }
}