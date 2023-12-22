<x-admin-layout>
    <a href="{{ route('admin.accommodations') }}" class="text-2xl">
        <i class="fa-solid fa-chevron-left"></i>
        <span>Back</span>
    </a>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <a href="{{ route('admin.accommodations') }}" class="inline-flex items-center gap-1 hover:underline">
            <span>Accommodations</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">New Accommodation</span>
    </div>

    <livewire:admin.accommodation-create-form/>
</x-admin-layout>
