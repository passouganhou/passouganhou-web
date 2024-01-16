<?php

namespace App\View\Components\Blog\Noticias;

use App\Models\SocialMedia\Article;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(
        public Article $noticia
    )
    {}

    public function render(): View
    {
        return view('components.blog.noticias.card');
    }
}
