<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Import the Log facade

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,gestionnaire,chauffeur',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request)
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function getAllUsers()
    {
        $users = User::all();

        return response()->json(['data' => $users]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $id,
            'role' => 'in:admin,gestionnaire,chauffeur',
            'password' => 'nullable|string|min:8|confirmed', // Password is now optional
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->name = $request->input('name', $user->name);
        $user->email = $request->input('email', $user->email);
        $user->role = $request->input('role', $user->role);

        // Only update the password if a new one is provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        try {
            $user->save();
            return response()->json(['data' => $user], 200);
        } catch (\Exception $e) {
            Log::error("Error updating user with ID: $id. " . $e->getMessage());
            return response()->json(['message' => "Impossible de modifier cet utilisateur. Veuillez réessayer."], 500);
        }
    }

    public function destroyUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        try {
            $user->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error("Error deleting user with ID: $id. " . $e->getMessage());
            return response()->json(['message' => "Impossible de supprimer cet utilisateur. Veuillez vérifier s'il n'est pas lié à d'autres enregistrements."], 400);
        }
    }
}
