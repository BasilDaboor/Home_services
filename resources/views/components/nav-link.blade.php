@props(['active'])

@php
    $classes = $active ?? false ? 'bg-gray-800 flex items-center' : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
