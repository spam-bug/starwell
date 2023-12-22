@props(['variety'])

<button {{ $attributes->class([
        'inline-flex items-center justify-center gap-2 border rounded px-4 py-2 whitespace-nowrap',
        'text-white bg-gray-900 border-gray-900' => $variety === 'primary',
        'text-gray-900 bg-white border-gray-300' => $variety === 'secondary',
        'text-white bg-green-500 border-green-500' => $variety === 'success',
        'text-white bg-red-500 border-red-500' => $variety === 'danger',
]) }}
>
    {{ $slot }}
</button>
