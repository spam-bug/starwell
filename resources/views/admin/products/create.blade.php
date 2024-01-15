<x-admin-layout>
    <a href="{{ route('admin.products') }}" class="text-2xl">
        <i class="fa-solid fa-chevron-left"></i>
        <span>Back</span>
    </a>

    <div class="mt-2 flex items-center gap-1 text-xs">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <a href="{{ route('admin.accommodations') }}" class="inline-flex items-center gap-1 hover:underline">
            <span>Equipments</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">New Equipments</span>
    </div>

    <livewire:admin.products-create-form />
</x-admin-layout>
