<?php

use Illuminate\Support\Facades\Route;
use App\FeatureFlags\Controllers\FeatureFlagApiController;
use App\CarDamageReports\Controllers\CarDamageReportsApiController;

Route::prefix('flags')->group(function () {
    Route::get('/', [FeatureFlagApiController::class, 'index']);
    Route::get('/{key}', [FeatureFlagApiController::class, 'show']);
});

Route::prefix('carReports')->group(function () {
    Route::get('/', [CarDamageReportsApiController::class, 'index']);
    Route::get('/{id}', [CarDamageReportsApiController::class, 'show']);
    Route::post('/', [CarDamageReportsApiController::class, 'store']);
    Route::put('/{id}', [CarDamageReportsApiController::class, 'update']);
    Route::delete('/{id}', [CarDamageReportsApiController::class, 'destroy']);
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});
