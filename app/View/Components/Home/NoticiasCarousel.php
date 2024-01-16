<?php

namespace App\View\Components\Home;

use App\Models\SocialMedia\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\View\Component;

class NoticiasCarousel extends Component
{
    public function render(): View
    {
        //\Cache::forget('noticias_carousel');
        $noticias = \Cache::remember('noticias_carousel', now()->addMinutes(8), function (){
            return Article::all();
        });

        $noticias->map(function ($noticia) {
            $noticia->setCover();
        });

        $noticias = $noticias->shuffle();
        return view('components.home.noticias-carousel', compact('noticias'));
    }
}
