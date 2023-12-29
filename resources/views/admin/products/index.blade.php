<x-admin-layout>
    <h1 class="text-3xl font-medium">Products</h1>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">Products</span>
    </div>

    <livewire:admin.products-data-table />
</x-admin-layout>
