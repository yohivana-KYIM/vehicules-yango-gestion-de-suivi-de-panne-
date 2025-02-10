<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

     /**
     * Récupération des informations de l'utilisateur connecté
     */
    public function me(Request $request)
    {
        $user = $request->user(); // Récupération de l'utilisateur connecté
        return response()->json([
            'message' => 'Informations de l\'utilisateur récupérées avec succès.',
            'data' => $user,
        ], 200);
    }


     public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid data',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        $user->password = Hash::make(Str::random(8));
        $user->save();

        return response()->json([
            'message' => 'Your new password has been generated, Please check your email'
        ], 200);
    }



    /**
     * Get all users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllUsers()
    {
        $users = User::all();

        return response()->json([
            'data' => $users,
        ]);
    }
}
