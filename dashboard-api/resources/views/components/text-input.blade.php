@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:violet-700 focus:ring-violet-700 rounded-md shadow-sm']) !!}>
