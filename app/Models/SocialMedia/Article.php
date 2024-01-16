<?php

namespace App\Models\SocialMedia;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Vite;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'socialmedial_articles';

    public function setCover()
    {
        $path = 'resources/images/';
        $imgFile = !empty($this->cover) ? 'posts/'.$this->cover : 'noticias_placeholder.jpg';
        $this->cover = Vite::asset($path . $imgFile);
    }
    protected $fillable = [
        'title',
        'abstract',
        'cover',
        'link',
        'author',
    ];
}
