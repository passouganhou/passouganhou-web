<?php

use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\SocialMedia\ArticleController;
use Illuminate\Support\Facades\Route;

//Blog Routes

Route::prefix('blog')->group(
    function () {
        Route::get('/', [PostController::class, 'index'])->name('blog.index');
        Route::get('noticias', [ArticleController::class, 'feed'])->name('noticias-em-destaque');
        Route::get('carnaval-empreendedor-estrategias-aumentar-vendas', function () {
            $metadata = new stdClass();
            $metadata->title = 'Carnaval empreendedor: estratégias de como aumentar as vendas';
            $metadata->description = 'Descubra estratégias eficazes para impulsionar suas vendas durante o Carnaval. Aproveite as dicas para garantir resultados significativos e se destaque durante a folia.';
            $metadata->keywords = 'carnaval; empreendedorismo; estratégias para aumentar vendas; passou ganhou; CND-RS';
            return view('pages.blog.placeholder', compact('metadata'));
        })->name('publicacao-aqui');
        Route::get('mulheres-empreendedoras-de-sucesso', function () {
            $metadata = new stdClass();
            $metadata->title = 'Mulheres empreendedoras: histórias de sucesso no mundo dos negócios';
            $metadata->description = 'Conheça as histórias inspiradoras de mulheres empreendedoras brasileiras que estão fazendo a diferença nos negócios. Saiba como essas empreendedoras alcançaram o sucesso e inspire-se.';
            $metadata->keywords = 'empreendedorismo feminino; negócios;';
            return view('pages.blog.noticias.ph2', compact('metadata'));
        })->name('publicacao-aqui-2');

        Route::get('passou-ganhou-sustentabilidade-feira-do-sebrae', function () {
            $metadata = new stdClass();
            $metadata->title = 'Passou Ganhou elimina meia tonelada de plástico na Feira do Sebrae com copos de fibra de arroz';
            $metadata->description = 'Descubra como a Passou Ganhou está revolucionando a sustentabilidade em eventos! Conheça nossa iniciativa na Feira do Sebrae, onde substituímos copos descartáveis por copos ecológicos de fibra de arroz, reduzindo o impacto ambiental e inspirando um futuro mais verde.';
            $metadata->keywords = 'Passou Ganhou, sustentabilidade, copos de fibra de arroz, Feira do Sebrae, redução de plásticos, inovação ecológica';
            return view('pages.blog.noticias.ph3', compact('metadata'));
        })->name('publicacao-aqui-3');
    }
);
