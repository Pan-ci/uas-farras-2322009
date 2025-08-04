@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-indigo-900 dark:text-indigo-500 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out no-underline'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-indigo-600 hover:text-gray-700 dark:hover:text-indigo-500 hover:border-gray-300 dark:hover:border-indigo-700 focus:outline-none focus:text-gray-700 dark:focus:text-indigo-300 focus:border-gray-300 dark:focus:border-indigo-700 transition duration-150 ease-in-out no-underline';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
