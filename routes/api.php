<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('projects', ProjectController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function() {
    return response()->json([
        'message' => 'API is working',
        'all_routes' => \Illuminate\Support\Facades\Route::getRoutes()->get()
    ]);
});
Route::get('/check-pgsql', function() {
    return extension_loaded('pdo_pgsql') ? 'pdo_pgsql loaded' : 'pdo_pgsql missing';
});



