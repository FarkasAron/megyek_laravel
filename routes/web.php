<?php

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\CountiesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// The auth-only routes (create/edit) must be registered before the public
// show route below, otherwise "GET cities/create" matches "cities/{city}"
// first and Laravel tries to look up a city with id "create" (404).
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('cities', CitiesController::class)->except(['index', 'show']);
    Route::resource('counties', CountiesController::class)->except(['index', 'show']);
});

Route::resource('cities', CitiesController::class)->only(['index', 'show']);
Route::resource('counties', CountiesController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
