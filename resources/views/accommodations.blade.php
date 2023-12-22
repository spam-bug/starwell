<x-guest-layout>
    <livewire:accommodations />

    <livewire:booking-form />

    @if(auth()->check() && auth()->user()->isCustomer())
        <x-dialog title="Booking Success" identifier="booking-success">
            <p>Thank you for booking with us. We will notify you once your booking has been confirmed and a down payment should be made.</p>

            <div class="flex items-center justify-center gap-2 mt-4">
                <x-button variety="secondary" class="w-full" x-on:click="$dispatch('close-dialog')">Continue Browsing</x-button>
                <x-button.link href="{{ route('bookings', auth()->user()) }}" wire:navigate variety="primary" class="w-full">Check Your Booking</x-button.link>
            </div>
        </x-dialog>
    @endif
</x-guest-layout>
