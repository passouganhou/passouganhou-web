@props([
    'type' => 'none'
])

<li class="{{ $type === 'item-mobile' ? 'my-1' : 'my-4'}} mx-3">
    <a {{ $attributes->class(['text-passou-magenta font-bold font-segoe-ui text-sm uppercase']) }}>
       {{ $slot }}
    </a>
</li>
