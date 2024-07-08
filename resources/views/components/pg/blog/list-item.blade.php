@props([
    'imgSrc' => false,
    'title' => false,
    'description' => false,
    'href' => false,
])

<div
{{ $attributes->class([
    'flex flex-col lg:flex-row border lg:border-0 hover:shadow-sm transition'
])}}
>
    <div class="lg:w-1/3 bg-passou-cyan">
        <img class="object-cover aspect-video lg:aspect-auto lg:h-full opacity-90" src="{{$imgSrc}}" alt="">
    </div>
    <div class="lg:w-2/3 px-6 py-2">
        <h2 class="text-2xl font-bold leading-8 tracking-tight">
            <a class="text-gray-900 hover:text-passou-cyan transition-colors" href="{{ $href }}"> {{ $title }}</a>
        </h2>
        <p class="prose mb-3 max-w-none text-gray-500 hover:text-gray-700">{{ \Illuminate\Support\Str::limit($description, 160) }}</p>
        <a href="{{ $href }}"
        class="font-medium leading-6 text-primary-500 hover:text-passou-cyan transition-colors"
        aria-label="Link to {{ $title }}">
        Continue lendo &rarr;
        </a>
    </div>
</div>
