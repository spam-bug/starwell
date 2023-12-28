@props(['variety'])

<span {{
    $attributes->class([
        'px-2 py-1 rounded text-xs font-medium inline-block',
        'bg-gray900-100 text-white' => $variety === 'primary',
        'bg-blue-100 text-blue-700' => $variety === 'info',
        'bg-green-100 text-green-700' => $variety === 'success',
        'bg-yellow-100 text-yellow-700' => $variety === 'warning',
        'bg-red-100 text-red-700' => $variety === 'danger',
    ])
}}>
    {{ $slot }}
</span>
