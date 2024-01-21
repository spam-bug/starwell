<x-admin-layout>
    <h1 class="text-3xl font-medium">Equipments</h1>

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

        <span class="text-gray-500">Equipments</span>
    </div>

    <form
        action="{{ route('admin.products.download') }}"
        method="GET"
        x-data="{ range: '' }"
        class="mt-8 flex items-center gap-4 rounded border border-gray-200 bg-white p-4"
    >
        @csrf

        <div class="flex items-center gap-2">
            <x-form.label>Product</x-form.label>
            <x-form.select class="max-w-[150px]" name="product">
                <option value="all">All</option>
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                @endif
            </x-form.select>
        </div>

        <div class="flex items-center gap-2">
            <x-form.label>Range</x-form.label>
            <x-form.select
                class="max-w-[150px]"
                x-model="range"
                name="range"
            >
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
