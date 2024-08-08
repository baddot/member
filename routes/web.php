<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BoosterController;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/{referral_code}', function ($referral_code) {
    $referrer = \App\Models\User::where('referral_code', $referral_code)->first();
    if ($referrer) {
        session(['referrer_code' => $referral_code]);
    }
    return redirect()->route('register');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/boosters', [BoosterController::class, 'index'])->name('boosters.index');
    Route::post('/boosters/purchase', [BoosterController::class, 'purchase'])->name('boosters.purchase');
    Route::post('/boosters/verify', [BoosterController::class, 'verify'])->name('boosters.verify');
    
    Route::post('/game/start', [GameController::class, 'start'])->name('game.start');
    Route::post('/game/finish', [GameController::class, 'finish'])->name('game.finish');

});

require __DIR__.'/auth.php';
