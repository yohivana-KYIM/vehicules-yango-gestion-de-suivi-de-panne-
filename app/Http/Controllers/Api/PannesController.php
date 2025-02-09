<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pannes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PannesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pannes = Pannes::with('vehicule', 'chauffeur')->get();
        return response()->json($pannes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nature' => 'required|string|max:255',
            'details' => 'nullable|string',
            'date_de_signalement' => 'required|date',
            'vehicule_id' => 'required|exists:vehicules,id',
            'chauffeur_id' => 'exists:chauffeurs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $panne = Pannes::create($request->all());
        return response()->json($panne, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pannes $panne)
    {
        $panne->load('vehicule', 'chauffeur');
        return response()->json($panne);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pannes $panne)
    {
        $validator = Validator::make($request->all(), [
            'nature' => 'string|max:255',
            'details' => 'nullable|string',
            'date_de_signalement' => 'date',
            'vehicule_id' => 'exists:vehicules,id',
            'chauffeur_id' => 'exists:chauffeurs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $panne->update($request->all());
        return response()->json($panne);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pannes $panne)
    {
        $panne->delete();
        return response()->json(null, 204);
    }

    /**
     * Report a panne (chauffeur specific).
     */
    public function reportPanne(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nature' => 'required|string|max:255',
            'details' => 'nullable|string',
            'date_de_signalement' => 'required|date',
            'vehicule_id' => 'required|exists:vehicules,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if the user is a chauffeur
        if ($user->role !== 'chauffeur') {
            return response()->json(['error' => 'Unauthorized. Only chauffeurs can report pannes using this endpoint.'], 403);
        }

        // Make sure there is a chauffeur profile
        if (!$user->chauffeur) {
            return response()->json(['error' => 'Chauffeur profile not found for this user.'], 400);
        }

        $panne = Pannes::create([
            'nature' => $request->nature,
            'details' => $request->details,
            'date_de_signalement' => $request->date_de_signalement,
            'vehicule_id' => $request->vehicule_id,
            'chauffeur_id' => $user->chauffeur->id, // Use chauffeur's ID
        ]);

        return response()->json($panne, 201);
    }
}