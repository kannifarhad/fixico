<?php

use Illuminate\Support\Facades\Route;
use App\FeatureFlags\Web\FeatureFlagController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin/flags')->group(function () {
    Route::get('/', [FeatureFlagController::class, 'index'])->name('flags.index');
    Route::get('/create', [FeatureFlagController::class, 'create'])->name('flags.create');
    Route::post('/', [FeatureFlagController::class, 'store'])->name('flags.store');
    Route::get('/{flag}/edit', [FeatureFlagController::class, 'edit'])->name('flags.edit');
    Route::put('/{flag}', [FeatureFlagController::class, 'update'])->name('flags.update');
    Route::delete('/{flag}', [FeatureFlagController::class, 'destroy'])->name('flags.destroy');
});
