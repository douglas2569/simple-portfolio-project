@props(['disabled' => false, 'value'])
<textarea
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'block p-2.5 w-full text-base text-gray-900 rounded-lg border border-gray-300 focus:ring-violet-700 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-violet-700 dark:focus:border-blue-500 mt-2']) !!}>{{ $value ?? $slot }}
</textarea>

