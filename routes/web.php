<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserGameController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [GameController::class, 'index'])->name('home');
Route::get('/game/{id}', [GameController::class, 'detail'])->name('game-details');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/my-game', [UserGameController::class, 'index'])->name('my-game');

    Route::post('/buy-game', [UserGameController::class, 'buyGame'])->name('buy-game');
    Route::post('/gift-game', [UserGameController::class, 'giftGame'])->name('gift-game');
});

require __DIR__.'/auth.php';
