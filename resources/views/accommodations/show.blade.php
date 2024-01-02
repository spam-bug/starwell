<x-guest-layout>
    <div class="w-full max-w-7xl mx-auto py-8">
        <div class="bg-white border border-gray-200 rounded">
            <div class="flex flex-col sm:flex-row gap-6 p-4 sm:p-6 lg:p-8">
                <div class="lg:w-1/2">
                    <img src="{{ asset($accommodation->photo) }}" alt="{{ $accommodation->name }} Photo">
                </div>

                <div>
                    <x-badge variety="info">{{ $accommodation->type }}</x-badge>
                    <h1 class="text-4xl font-medium mt-2">{{ $accommodation->name }}</h1>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $accommodation->price() }}</p>
                    @if($accommodation->type === \App\Enums\AccommodationType::Resort)
                        <p class="text-gray-500 mt-4">{{ $accommodation->max_person }} Max Persons</p>
                    @elseif($accommodation->type === \App\Enums\AccommodationType::Restobar)
                        <p class="text-gray-500 mt-4">{{ $accommodation->max_person }} Max Persons</p>
                        <p class="text-gray-500">{{ $accommodation->max_daily_capacity }} Daily Capacity</p>
                    @elseif($accommodation->type === \App\Enums\AccommodationType::Barbershop)
                        <p class="text-gray-500 mt-4">{{ $accommodation->max_daily_capacity }} Daily Capacity</p>
                    @else
                        <p class="text-gray-500 mt-4">Monthly Subscription</p>
                    @endif

                    <livewire:booking-and-membership-form :$accommodation />
                </div>
            </div>

            <div>
                <div class="flex items-center gap-2 border-y border-gray-200 px-4 py-2 text-gray-700">
                    <i class="fa-solid fa-circle-info"></i>
                    <h6 class="font-bold">Description</h6>
                </div>
                <div class="p-4 sm:p-6 lg:p-8 whitespace-pre-line text-lg text-gray-500">
                    {{ $accommodation->description }}
                </div>
            </div>
        </div>
    </div>

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
