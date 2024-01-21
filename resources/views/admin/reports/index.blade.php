<x-admin-layout>
    @if (session()->has('error'))
        <div class="mb-4 rounded bg-red-100 px-4 py-2 text-red-700">
            {{ session('error') }}
        </div>
    @endif
    <h1 class="text-3xl font-medium">Reports</h1>

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

        <span class="text-gray-500">Reports</span>
    </div>

    <div class="mt-8 grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4 lg:gap-8">
        <livewire:admin.transactions-total />
        <livewire:admin.transaction-monthly-total />
        <livewire:admin.transactions-pending-total />
        <livewire:admin.transactions-count />
    </div>

    <form
        action="{{ route('admin.reports.download') }}"
        method="GET"
        x-data="{ range: '' }"
        class="mt-8 flex items-center gap-4 rounded border border-gray-200 bg-white p-4"
    >
        @csrf

        <div class="flex items-center gap-2">
            <x-form.label>Accommodations</x-form.label>
            <x-form.select class="max-w-[150px]" name="accommodation">
                <option value="all">All</option>
                @foreach (\App\Enums\AccommodationType::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->name }}</option>
                @endforeach
            </x-form.select>
        </div>

        <div class="flex items-center gap-2">
            <x-form.label>Type</x-form.label>
            <x-form.select class="max-w-[150px]" name="type">
                <option value="all">All</option>
                <option value="reservation">Reservation</option>
                <option value="subscription">Subscription</option>
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

    <livewire:admin.transactions-data-table />
</x-admin-layout>
