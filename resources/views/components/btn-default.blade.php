@props([
    'chevronRight' => false,
    'bg' => false
])

<a {{ $attributes->class([
    'bg-passou-cyan text-white flex items-center justify-center rounded-full py-3 uppercase transition-all duration-200 group cursor-pointer',
    'hover:bg-white hover:text-passou-magenta' => !$bg,
    'hover:bg-passou-magenta hover:text-white' => $bg,
    ]) }}>
    <span class="mr-2">{{ $slot }}</span>
    {{ $icon ?? ''}}
    @if ($chevronRight)
        <x-icons name="chevron-right" class="fill-white {{ $bg ? 'group-hover:fill-white': 'group-hover:fill-passou-magenta' }} transition-all duration-200" />
    @endif
</a>
