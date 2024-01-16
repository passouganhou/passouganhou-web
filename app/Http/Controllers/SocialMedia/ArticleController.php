<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;

class ArticleController extends Controller
{

    public function feed()
    {
        $articles = Article::paginate(6);
        $articles->map(function ($article) {
            $article->setCover();
        });
        return view('pages.blog.noticias.index', compact('articles'));
    }
    public function index()
    {
        return Article::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'abstract' => ['nullable'],
            'cover' => ['nullable'],
            'link' => ['required'],
            'author' => ['required'],
        ]);

        return Article::create($data);
    }

    public function show(Article $article)
    {
        return $article;
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['required'],
            'abstract' => ['nullable'],
            'cover' => ['nullable'],
            'link' => ['required'],
            'author' => ['required'],
        ]);

        $article->update($data);

        return $article;
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json();
    }
}
