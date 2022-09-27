<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PecaMaquininhaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('peca-a-sua', function () {
    return view('pages.peca-maquininha');
})->name('peca-maquininha.index');


Route::get('venda-pela-internet', function () {
    return view('pages.venda-pela-internet');
})->name('venda-pela-internet.index');

Route::middleware('auth')->group(function () {
    Route::post('export-contacts', [ExportController::class, 'export'])->name('export.contacts');
});
