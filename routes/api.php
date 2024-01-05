<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(
    [
        'middleware' => ['api', 'verify.static.token'],
    ],
    function ($router) {
        Route::prefix('/simulator')->group(function () {
            Route::get('/mccs', [\App\Http\Controllers\Api\SimulatorController::class, 'index'])->name('simulator.index');
            Route::get('/mccs/{mcc}', [\App\Http\Controllers\Api\SimulatorController::class, 'show'])->name('simulator.show');
            Route::get('/get-mcc-options', [\App\Http\Controllers\Api\SimulatorController::class, 'getMCCOptions']);
            Route::post('/calculate', [\App\Http\Controllers\Api\SimulatorController::class, 'simulateResults']);
            Route::get('/get-acquirer-costs/{mcc?}', [\App\Http\Controllers\Api\SimulatorController::class, 'fetchAcquirerCosts'])->name('simulator.getAcquirerCosts');
        });
    }
);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
