<x-admin-layout>
    <h1 class="text-3xl font-medium">Reports</h1>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">Reports</span>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 mt-8">
        <livewire:admin.transactions-total />
        <livewire:admin.transaction-monthly-total />
        <livewire:admin.transactions-pending-total />
        <livewire:admin.transactions-count />
    </div>

    <livewire:admin.transactions-data-table />
</x-admin-layout>
