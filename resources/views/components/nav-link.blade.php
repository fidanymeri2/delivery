@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#2854C5] text-sm font-medium leading-5 text-[#2854C5] focus:outline-none focus:border-[#2854C5] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-[#2854C5] hover:border-[#2854C5] focus:outline-none focus:text-[#2854C5] focus:border-[#2854C5] transition duration-150 ease-in-out';

$svgFillColor = $active ? 'fill-[#2854C5]' : 'fill-gray-500';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
