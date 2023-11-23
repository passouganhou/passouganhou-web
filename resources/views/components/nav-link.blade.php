@props([
    'type' => 'none',
    'color' => 'text-passou-magenta',
])
@php($class = 'font-bold font-segoe-ui text-sm uppercase' . ' ' . $color)
<li class="{{ $type === 'item-mobile' ? 'my-1' : 'my-4'}} mx-3">
    <a {{ $attributes->class([$class]) }}>
       {{ $slot }}
    </a>
</li>
