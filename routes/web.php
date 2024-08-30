<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    Route::get('/friends', [FriendController::class, 'index'])->name('friends');
    Route::get('/community', [UserController::class, 'community'])->name('community');
    Route::get('/message/{id}', [MessageController::class, 'index'])->name('message');
    Route::get('/topup', [UserController::class, 'topupPage'])->name('topup-page');

    Route::post('/topup', [UserController::class, 'topup'])->name('topup');
    Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send-message');
    Route::post('/add-friend', [FriendController::class, 'addFriend'])->name('add-friend');
    Route::post('/remove-friend', [FriendController::class, 'removeFriend'])->name('remove-friend');
    Route::post('/accept-friend', [FriendController::class, 'acceptFriend'])->name('accept-friend');
    Route::post('/decline-friend', [FriendController::class, 'declineFriend'])->name('decline-friend');
    Route::post('/buy-game', [UserGameController::class, 'buyGame'])->name('buy-game');
    Route::post('/gift-game', [UserGameController::class, 'giftGame'])->name('gift-game');
});

require __DIR__.'/auth.php';
