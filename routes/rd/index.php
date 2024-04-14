<?php

use Illuminate\Support\Facades\Route;

Route::prefix('rd')->group(
    function () {
        Route::get('/login', [\App\Http\Controllers\Simulador\WebController::class, 'login'])->name('rd.login');
        Route::get('/callback', [\App\Http\Controllers\Simulador\WebController::class, 'callback'])->name('rd.callback');
        Route::group(
            ['middleware' => [\App\Http\Middleware\RD\RDStationAuthMiddleware::class]],
            function () {
                Route::get('/simulador-proposta', [\App\Http\Controllers\Simulador\WebController::class, 'simuladorProposta'])->name('rd.simulador-proposta');
                Route::get('/negociacoes', [\App\Http\Controllers\Simulador\WebController::class, 'negociacoes'])->name('rd.negociacoes');
            }
        );

    }
);
