<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vite;

class PostController extends Controller
{

    /*public function debug()
    {
        $post = Post::first();
        $media = $post->getMedia('cover');
        $mediaUrl = $media->first()->getUrl();
        dd($media, $mediaUrl);
        return view('pages.dev.debug');
    }

    public function testUploadedPhoto(Request $request)
    {
        $previewUrl = $request->file('cover')->store('photos', 'public');
        $path = storage_path('app/public/'.$previewUrl);
        //dd($path);
        //add media to post
        $post = Post::first();
        $post->addMedia($path)->toMediaCollection('cover');
        dd($post);

    }*/
    public function index()
    {
        $posts = [
            [
                'title' => 'Mulheres empreendedoras: histórias de sucesso no mundo dos negócios',
                'summary' => 'Conheça histórias de mulheres empreendedoras brasileiras que estão conquistando o sucesso nos negócios, com dados do Sebrae e apoio da Passou Ganhou.',
                'tags' => ['empreendedorismo feminino', 'negócios'],
                'categories' => ['Empreendedorismo'],
                'slug' => 'mulheres-empreendedoras-de-sucesso',
                'published_at' => '2024-02-28',
                'cover' => Vite::asset('resources/images/posts/2/vista-frontal-mulheres-modernas-trabalhando-juntos.webp')
            ],
            [
                'title' => 'Carnaval empreendedor: estratégias de como aumentar as vendas',
                'summary' => 'O Carnaval é considerado a maior festa popular brasileira, regado a uma explosão de cores, ritmos e celebrações que contagia multidões em várias cidades do país. E, para os empreendedores, é também uma excelente oportunidade para impulsionar as vendas e alavancar os resultados significativos.

Por isso, vamos explorar estratégias eficazes e práticas de como aumentar as vendas durante o Carnaval, garantindo que o seu negócio não fique de fora da festa, mas também que tenha resultados significativos.',
                'tags' => ['tag1', 'tag2'],
                'categories' => ['Negócios e Empreendedorismo'],
                'slug' => 'carnaval-empreendedor-estrategias-aumentar-vendas',
                'published_at' => '2024-01-31',
                'cover' => Vite::asset('resources/images/posts/1/pessoas-sorridentes-de-tiro-medio-dancando-ao-ar-livre.webp')
            ]
        ];
        // transform the posts to a collection of models
        $posts = collect($posts)->map(function ($post) {
            return (object)$post;
        });
        //dd($posts);
        return view('pages.blog.index', compact('posts'));
    }
/*
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required'],
            'summary' => ['nullable'],
            'content' => ['required'],
            'tags' => ['nullable'],
            'categories' => ['nullable'],
            'seo_keywords' => ['nullable'],
            'seo_title' => ['nullable'],
            'slug' => ['required'],
            'meta_description' => ['nullable'],
            'published_at' => ['required', 'date'],
        ]);

        return Post::create($data);
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => ['required'],
            'summary' => ['nullable'],
            'content' => ['required'],
            'tags' => ['nullable'],
            'categories' => ['nullable'],
            'seo_keywords' => ['nullable'],
            'seo_title' => ['nullable'],
            'slug' => ['required'],
            'meta_description' => ['nullable'],
            'published_at' => ['required', 'date'],
        ]);

        $post->update($data);

        return $post;
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json();
    }*/
}
