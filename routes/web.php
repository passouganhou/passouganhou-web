<?php

use App\Filament\Pages\GeneralSettingsPage;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PecaMaquininhaController;
use App\Models\Contact;
use App\Services\CrmService;
use App\Settings\GeneralSettings;
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

Route::get('/', function (GeneralSettings $settings) {
    // $contact = Contact::first();
    // $data = $contact->only([
    //     'name',
    //     'email',
    //     'phone',
    //     'quero_maquininha',
    //     'quero_vender_online',
    //     'form'
    // ]);
    // $service = new CrmService($data);
    // $service->serviceId('asd')->send();
    return view('pages.home-bf', compact('settings'));
})->name('home');

Route::get('blog/noticias', [\App\Http\Controllers\SocialMedia\ArticleController::class, 'feed'])->name('noticias-em-destaque');
Route::get('blog/carnaval-empreendedor-estrategias-aumentar-vendas', function (){
    $metadata = new stdClass();
    $metadata->title = 'Carnaval empreendedor: estratégias de como aumentar as vendas';
    $metadata->description = 'Descubra estratégias eficazes para impulsionar suas vendas durante o Carnaval. Aproveite as dicas para garantir resultados significativos e se destaque durante a folia.';
    $metadata->keywords = 'carnaval; empreendedorismo; estratégias para aumentar vendas; passou ganhou; CND-RS';
    return view('pages.blog.placeholder', compact('metadata'));
})->name('publicacao-aqui');

Route::get('faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('peca-a-sua', function (GeneralSettings $settings) {
    return view('pages.peca-maquininha', compact('settings'));
})->name('peca-maquininha.index');

Route::get('canaldatransparencia', function () {
    return view('pages.canal-de-transparencia');
})->name('canal-de-transparencia');

Route::get('dev/poc', function () {
   return view('pages.dev.poc');
});

// Route::get('venda-pela-internet', function () {
//     return view('pages.venda-pela-internet');
// })->name('venda-pela-internet.index');

Route::get('termos-e-condicoes-de-uso', function () {
    return view('pages.termos-condicoes-de-uso');
})->name('termos-e-condicoes-de-uso');
Route::get('politica-de-privacidade', function () {
    return view('pages.politica-de-privacidade');
})->name('politica-de-privacidade');

Route::middleware('auth')->group(function () {
    Route::post('export-contacts', [ExportController::class, 'export'])->name('export.contacts');
});
