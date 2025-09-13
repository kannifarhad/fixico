<?php

use Illuminate\Support\Facades\Route;
use App\FeatureFlags\Api\FeatureFlagController;

Route::get('/flags', [FeatureFlagController::class, 'index']);
Route::get('/flags/{key}', [FeatureFlagController::class, 'show']);
