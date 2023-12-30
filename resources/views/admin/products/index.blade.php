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

    <form
        action="{{ route('admin.products.download') }}"
        method="GET"
        x-data="{ range: '' }"
        class="bg-white rounded border border-gray-200 p-4 mt-8 flex items-center gap-4"
    >
        @csrf

        <div class="flex items-center gap-2">
            <x-form.label>Range</x-form.label>
            <x-form.select class="max-w-[150px]" x-model="range" name="range">
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
                <option value="custom">Custom</option>
            </x-form.select>
        </div>

        <template x-if="range === 'custom'">
            <div class="flex gap-4">
                <div class="flex items-center gap-2">
                    <x-form.label>From</x-form.label>
                    <x-form.input type="date" name="from" />
                    <x-form.error for="from" />
                </div>

                <div class="flex items-center gap-2">
                    <x-form.label>To</x-form.label>
                    <x-form.input type="date" name="to" />
                    <x-form.error for="to" />
                </div>
            </div>
        </template>

        <x-button variety="primary">Generate</x-button>
    </form>

    <livewire:admin.products-data-table />
</x-admin-layout>
