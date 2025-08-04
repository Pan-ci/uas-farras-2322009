@props(['value'])

@php
    $classes = $attributes->has('class') 
        ? $attributes->get('class') 
        : 'custom-class-default';
@endphp

<label {{ $attributes->except('class') }} class="{{ $classes }}">
    {{ $value ?? $slot }}
</label>
