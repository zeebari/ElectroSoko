<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashibodiController,
    BidhaaController,
    WatejaController,
    MauzoController,
    MalipoController,
    MadeniController,
    JardiController,
};

Route::get('/', [DashibodiController::class, 'index'])->name('dashibodi');

Route::resource('bidhaa', BidhaaController::class)->except(['show']);

Route::resource('wateja', WatejaController::class);
Route::get('wateja/{mteja}/sarafu', [WatejaController::class, 'sarafu'])->name('wateja.sarafu');

Route::resource('mauzo', MauzoController::class)->except(['edit', 'update']);

Route::post('malipo/{uuzaji}', [MalipoController::class, 'store'])->name('malipo.store');

Route::get('madeni', [MadeniController::class, 'index'])->name('madeni.index');

Route::get('jardi', [JardiController::class, 'index'])->name('jardi.index');
