@props([
    'type' => 'none'
])

<li class="{{ $type === 'item-mobile' ? 'my-1' : 'my-4'}} mx-3">
    <a class="text-white font-bold font-segoe-ui text-sm uppercase" {{ $attributes }}>
       {{ $slot }}
    </a>
</li>
