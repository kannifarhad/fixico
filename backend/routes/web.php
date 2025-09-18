<?php

use Illuminate\Support\Facades\Route;
use App\FeatureFlags\Controllers\FeatureFlagWebController;

Route::prefix('admin')->group(function () {
    Route::get('/', [FeatureFlagWebController::class, 'index'])->name('featureFlags.index');
    Route::get('/create', [FeatureFlagWebController::class, 'create'])->name('featureFlags.create');
    Route::post('/', [FeatureFlagWebController::class, 'store'])->name('featureFlags.store');
    Route::get('/{flag}/edit', [FeatureFlagWebController::class, 'edit'])->name('featureFlags.edit');
    Route::put('/{flag}', [FeatureFlagWebController::class, 'update'])->name('featureFlags.update');
    Route::delete('/{flag}', [FeatureFlagWebController::class, 'destroy'])->name('featureFlags.destroy');
});

Route::fallback(function () {
    abort(404);
});
