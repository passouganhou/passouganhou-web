<div class="flex flex-col sm:flex-row gap-4 border-t border-b sm:border-r transition hover:sm:shadow">
    <div class="w-full sm:w-4/12">
        <img class="object-cover h-full" src="{{$noticia->cover}}" alt="">
    </div>
    <div class="flex flex-col w-full sm:w-8/12 justify-between py-4">
        <div class="">
            <h2 class="text-2xl font-semibold">{{$noticia->title}}</h2>
        </div>
        <div class="flex flex-col justify-around gap-4 my-4 sm:my-0 sm:px-2">
            <p class="text-gray-800">{{$noticia->abstract}}</p>
            <span class="text-gray-500 italic">Publicado por {{$noticia->author}}</span>
        </div>
        <div class="flex w-full sm:w-auto">
            <a href="{{$noticia->link}}" target="_blank" class="px-12 py-4 w-full sm:w-auto text-center text-xl sm:text-lg transition-all font-medium bg-passou-magenta text-white hover:bg-passou-cyan">Saiba mais</a>
        </div>
    </div>
</div>
