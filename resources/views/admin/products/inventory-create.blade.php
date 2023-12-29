<x-admin-layout>
    <a href="{{ route('admin.products.inventories') }}" class="text-2xl">
        <i class="fa-solid fa-chevron-left"></i>
        <span>Back</span>
    </a>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <a href="{{ route('admin.products') }}" class="inline-flex items-center gap-1 hover:underline">
            <span>Products</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <a href="{{ route('admin.products.inventories') }}" class="inline-flex items-center gap-1 hover:underline">
            <span>Inventory</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">New Record</span>
    </div>

    <livewire:admin.product-inventory-create-form/>
</x-admin-layout>
