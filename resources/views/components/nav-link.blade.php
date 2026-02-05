@props(['active'])

@php
$classes = ($active ?? false)
    ? 'inline-flex items-center px-3 py-2 border-b-2 border-blue-500 text-sm font-medium text-blue-600 transition-colors duration-150'
    : 'inline-flex items-center px-3 py-2 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-blue-600 hover:border-blue-400 transition-colors duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>