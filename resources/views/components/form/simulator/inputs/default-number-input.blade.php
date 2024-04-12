@props([
    'label' => false,
    'id' => false,
    'min' => 0,
    'step' => '0.01'
])
@php($class = $attributes->get('class'))
<div class="flex flex-col w-full {{$class}}">
    <label class="font-medium" for="{{$id}}">{{$label}}</label>
    <input type="number" name="{{$id}}" id="{{$id}}" class="border border-slate-300 rounded-lg" value="{{$min}}" min="{{$min}}" step="{{$step}}">
</div>
