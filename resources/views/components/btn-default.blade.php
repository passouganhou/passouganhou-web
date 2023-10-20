@props([
    'chevronRight' => false,
    'arrowRight' => false,
    'bg' => false,
    'whiteBg' => false,
])

<a {{ $attributes->class([
    'flex items-center justify-center rounded-full py-3 uppercase transition-all duration-200 group cursor-pointer',
    'bg-passou-cyan text-white' => !$whiteBg,
    'bg-white text-passou-cyan' => $whiteBg,
    'hover:bg-white hover:text-passou-magenta' => !$bg,
    'hover:bg-passou-magenta hover:text-white' => $bg,
    ]) }}>
    <span class="mr-2">{{ $slot }}</span>
    {{ $icon ?? ''}}
    @if ($chevronRight)
        <x-icons name="chevron-right" class="{{$whiteBg ? 'fill-passou-cyan' : 'fill-white'}} {{ $bg ? 'group-hover:fill-white': 'group-hover:fill-passou-magenta' }} transition-all duration-200" />
    @endif
    @if($arrowRight)
        <x-icons name="arrow-right" class="{{$whiteBg ? 'fill-passou-cyan' : 'fill-white'}} {{ $bg ? 'group-hover:fill-white': 'group-hover:fill-passou-magenta' }} transition-all duration-200" />
    @endif
</a>
