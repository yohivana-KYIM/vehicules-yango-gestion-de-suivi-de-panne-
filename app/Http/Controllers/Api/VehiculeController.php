<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicules = Vehicule::with('pannes', 'interventions')->get(); // Load relationships
        return response()->json($vehicules);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marque' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'nom_proprietaire' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vehicule = Vehicule::create($request->all());
        return response()->json($vehicule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicule $vehicule)
    {
        $vehicule->load('pannes', 'interventions'); // Load relationships
        return response()->json($vehicule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        $validator = Validator::make($request->all(), [
            'marque' => 'string|max:255',
            'model' => 'string|max:255',
            'nom_proprietaire' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vehicule->update($request->all());
        return response()->json($vehicule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return response()->json(null, 204);
    }
}