@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge(['class' => 'border border-gray-300 bg-white text-gray-800 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
