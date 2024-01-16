<div class="swiffy-slider slider-item-show3 slider-item-show2-sm slider-item-reveal slider-item-ratio slider-item-ratio-1x1 slider-nav-square slider-nav-sm slider-nav-outside slider-indicators-dark slider-indicators-round slider-indicators-outside slider-indicators-sm slider-nav-animation slider-nav-animation-fadein slider-nav-animation-fast">
    <ul class="slider-container">
        @foreach($noticias as $noticia)
            <li>
                <div class="flex" style="background: url('{{$noticia->cover}}'); background-size: cover; background-repeat: no-repeat; background-position: center;">
                    <div class="text-white p-8 w-full h-full flex flex-col backdrop-brightness-50 bg-black/30">
                        <div class="place-self-center my-auto flex flex-col gap-2">
                            <hr class="w-4/12 border-2 place-self-center">
                            <a class="drop-shadow-lg text-center sm:text-base font-medium" href="{{$noticia->link}}" target="_blank">{{$noticia->title}}</a>
                        </div>
                        <span class="place-self-end text-xs sm:text-sm">{{$noticia->author}}</span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>

    <button type="button" class="slider-nav"></button>
    <button type="button" class="slider-nav slider-nav-next"></button>

    <ul class="slider-indicators">
        @foreach($noticias as $noticia)
            <li></li>
        @endforeach
    </ul>
</div>
