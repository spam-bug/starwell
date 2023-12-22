@props(['size' => 'lg', 'title', 'identifier'])

<template x-teleport="body">
    <div
        class="w-full h-screen fixed inset-0 z-50"
        x-data="{ open: false, identifier: @js($identifier) }"
        x-on:open-dialog.window="open = identifier === event.detail || identifier === event.detail.identifier"
        x-on:close-dialog.window="open = false"
        x-on:keydown.esc.window="open = false"
        x-show="open"
        x-cloak
        x-transition:enter="transition-all ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-32"
        x-transition:enter-end="opacity-100 translate-y-0"
    >
        <div
            @class([
                'bg-white w-full absolute top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 shadow-lg rounded overflow-hidden',
                'max-w-sm' => $size === "sm",
                'max-w-md' => $size === "md",
                'max-w-lg' => $size === "lg",
                'max-w-xl' => $size === "xl",
                'max-w-2xl' => $size === "2xl",
            ])
             x-on:click.outside="open = false"
        >
            <div class="p-4 flex items-center justify-between border-b border-gray-300">
                <h6 class="text-2xl font-medium capitalize">{{ $title }}</h6>

                <button class="flex items-center" x-on:click="open = false">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</template>
