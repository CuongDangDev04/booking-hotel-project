@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link active text-sm font-medium text-primary focus:outline-none focus:ring-2 focus:ring-indigo-700 transition duration-150 ease-in-out'
            : 'nav-link text-sm font-medium text-muted hover:text-dark focus:outline-none focus:ring-2 focus:ring-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
