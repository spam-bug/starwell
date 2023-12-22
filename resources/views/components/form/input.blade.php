<input {{ $attributes->class([
    'w-full block bg-white border border-gray-300 rounded px-4 py-2 disabled:bg-gray-100',
    'border-red-500' => $errors->has($attributes->whereStartsWith('wire:model')->first() || $attributes->get('name'))
]) }}>
