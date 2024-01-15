<x-admin-layout>
    <h1 class="text-3xl font-medium">Inventory</h1>

    <div class="mt-2 flex items-center gap-1 text-xs">
        <a
            href="{{ route('admin.dashboard') }}"
            wire:navigate
            class="inline-flex items-center gap-1 hover:underline"
        >
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <a
            href="{{ route('admin.products') }}"
            wire:navigate
            class="inline-flex items-center gap-1 hover:underline"
        >
            Equipments
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">Inventory</span>
    </div>

    <livewire:admin.product-inventory-data-table />
</x-admin-layout>
