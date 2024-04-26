<?php

use Illuminate\Support\Facades\Route;

Route::prefix('rd')->middleware('auth')->group(
    function () {
        Route::get('/auth/rd-token-check', [\App\Http\Controllers\Simulador\WebController::class, 'login'])->name('rd.login');
        Route::get('/callback', [\App\Http\Controllers\Simulador\WebController::class, 'callback'])->name('rd.callback');
        Route::post('/auth/check-token', [\App\Http\Controllers\Simulador\WebController::class, 'checkToken'])->name('rd.check-token');
        Route::get('/history', [\App\Http\Controllers\Simulador\WebController::class, 'simulationHistory'])->name('rd.history');
        Route::group(
            ['middleware' => [\App\Http\Middleware\RD\RDStationAuthMiddleware::class]],
            function () {
                Route::get('/simulador-proposta', [\App\Http\Controllers\Simulador\WebController::class, 'simuladorProposta'])->name('rd.simulador-proposta');
                Route::get('/negociacoes', [\App\Http\Controllers\Simulador\WebController::class, 'negociacoes'])->name('rd.negociacoes');
                Route::get('/negociacoes/{id}/proposta', [\App\Http\Controllers\Simulador\WebController::class, 'proposta'])->name('rd.proposta');
            }
        );

    }
);
