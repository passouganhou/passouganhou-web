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
            Route::post('/submit', [\App\Http\Controllers\Api\SimulatorController::class, 'submitSimulation']);
            Route::get('/get-acquirer-costs/{mcc?}', [\App\Http\Controllers\Api\SimulatorController::class, 'fetchAcquirerCosts'])->name('simulator.getAcquirerCosts');
        });
    }
);

Route::prefix('/rd-webhook')->group(function () {
    Route::post('/oportunities', [\App\Http\Controllers\Api\RDWebhookController::class, 'listenOportunities'])->name('rd-webhook.oportunities');
    Route::get('/oportunities', [\App\Http\Controllers\Api\RDWebhookController::class, 'getOportunities'])->name('rd-webhook.getOportunities');
});

Route::prefix('v1')->group(function () {
    //Route::post('photo/upload', [\App\Http\Controllers\Api\PhotoController::class, 'upload'])->name('api.photo.upload');
    Route::prefix('gsurf')->group(function () {
        Route::get('merchants', [\App\Http\Controllers\Api\GsurfController::class, 'getMerchants'])->name('api.gsurf.merchants');
        Route::get('transactions-by-customer', [\App\Http\Controllers\Api\TransactionController::class, 'transactionsByCustomer']);
        Route::get('transactions-by-customer/most-valuable', [\App\Http\Controllers\Api\TransactionController::class, 'getMostValuableCustomers']);
        Route::get('transactions-by-customer/less-valuable', [\App\Http\Controllers\Api\TransactionController::class, 'getLessValuableCustomers']);
        Route::get('transactions-by-date', [\App\Http\Controllers\Api\TransactionController::class, 'getAll']);
        Route::prefix('transactions')->group(function () {
            Route::get('/', [\App\Http\Controllers\Api\TransactionController::class, 'index']);
            Route::get('import', [\App\Http\Controllers\Api\GsurfController::class, 'importar'])->name('api.importar');
            Route::get('total', [\App\Http\Controllers\Api\TransactionController::class, 'getTotalTransactions']);
            Route::get('total-by-day', [\App\Http\Controllers\Api\GsurfController::class, 'getValuesAndQuantityByDay']);
        });
    });

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
