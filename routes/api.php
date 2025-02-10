<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VehiculeController;
use App\Http\Controllers\Api\InterventionController;
use App\Http\Controllers\Api\MecanicienController;
use App\Http\Controllers\Api\ChauffeurController;
use App\Http\Controllers\Api\PiecesUtiliseesController;
use App\Http\Controllers\Api\PannesController;
use App\Http\Controllers\Api\EntretienPreventifController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);



Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [AuthController::class, 'getAllUsers']); // Ajout de la route pour récupérer tous les utilisateurs
});

    Route::apiResource('vehicules', VehiculeController::class);
    Route::apiResource('interventions', InterventionController::class);
    Route::apiResource('mecaniciens', MecanicienController::class);
    Route::apiResource('chauffeurs', ChauffeurController::class);
    Route::apiResource('pieces-utilisees', PiecesUtiliseesController::class);
    Route::apiResource('pannes', PannesController::class);
    Route::apiResource('entretien-preventifs', EntretienPreventifController::class);

    Route::middleware(['role:admin'])->group(function () {
        // Routes accessible only to admins
    });

    Route::middleware(['role:gestionnaire,admin'])->group(function () {
        // Routes accessible to gestionnaires and admins
    });

    Route::middleware(['role:chauffeur'])->group(function () {
        // Routes accessible to chauffeurs
        Route::post('/pannes/report', [Api\PannesController::class, 'reportPanne']); //Example
    });


