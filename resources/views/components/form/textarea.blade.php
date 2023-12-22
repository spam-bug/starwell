<textarea {{ $attributes->class([
    'w-full min-h-[150px] block bg-white border border-gray-300 rounded px-4 py-2 disabled:bg-gray-100 whitespace-pre-line',
    'border-red-500' => $errors->has($attributes->whereStartsWith('wire:model')->first() || $attributes->get('name'))
]) }}
></textarea>
