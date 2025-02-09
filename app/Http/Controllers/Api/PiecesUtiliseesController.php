<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PiecesUtilisees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PiecesUtiliseesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $piecesUtilisees = PiecesUtilisees::with('intervention')->get();
        return response()->json($piecesUtilisees);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fournisseur' => 'required|string|max:255',
            'date_de_montage' => 'required|date',
            'date_de_changement' => 'required|date',
            'intervention_id' => 'required|exists:interventions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pieceUtilisee = PiecesUtilisees::create($request->all());
        return response()->json($pieceUtilisee, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(PiecesUtilisees $pieceUtilisee)
    {
        $pieceUtilisee->load('intervention');
        return response()->json($pieceUtilisee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PiecesUtilisees $pieceUtilisee)
    {
        $validator = Validator::make($request->all(), [
            'fournisseur' => 'string|max:255',
            'date_de_montage' => 'date',
            'date_de_changement' => 'date',
            'intervention_id' => 'exists:interventions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pieceUtilisee->update($request->all());
        return response()->json($pieceUtilisee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PiecesUtilisees $pieceUtilisee)
    {
        $pieceUtilisee->delete();
        return response()->json(null, 204);
    }
}