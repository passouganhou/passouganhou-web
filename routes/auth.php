<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [LoginController::class, 'authenticateUser'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('dashboard')->middleware('auth')->group(
    function (){
        Route::get('/', function () {
            return view('auth.dashboard');
        })->name('dashboard');
    }
);
