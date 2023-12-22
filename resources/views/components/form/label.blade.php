@props(['required' => false])

<label {{ $attributes->class(['capitalize font-medium text-sm']) }}>
    {{ $slot }}

    @if ($required)
        <span class="text-red-500">*</span>
    @endif
</label>
