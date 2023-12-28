<div class="mt-4">
    <form wire:submit="{{ $accommodation->type === \App\Enums\AccommodationType::Gym ? 'join' : 'book' }}">
        @if($accommodation->type === \App\Enums\AccommodationType::Resort)
            <div class="sm:flex sm:gap-4">
                <x-form.group>
                    <x-form.label for="checkin_date">Check In Date</x-form.label>
                    <x-form.input type="datetime-local" id="checkin_date" wire:model.blur="checkinDate" />
                    <x-form.error for="checkIn" />
                </x-form.group>

                <x-form.group>
                    <x-form.label for="checkout_date">Check Out Date</x-form.label>
                    <x-form.input type="datetime-local" id="checkout_date" wire:model.blur="checkoutDate" />
                    <x-form.error for="checkOut" />
                </x-form.group>
            </div>
        @elseif($accommodation->type === \App\Enums\AccommodationType::Restobar || $accommodation->type === \App\Enums\AccommodationType::Barbershop)
            <x-form.group>
                <x-form.label for="booking_date">Booking Date</x-form.label>
                <x-form.input type="datetime-local" id="booking_date" wire:model.blur="bookingDate" />
                <x-form.error for="bookingDate" />
            </x-form.group>
        @endif

        @if($accommodation->type !== \App\Enums\AccommodationType::Gym)
            <x-form.group>
                <x-form.label for="person-quantity">How many person?</x-form.label>
                <x-form.input type="number" id="person-quantity" wire:model.blur="personQuantity" />
                <x-form.error for="personQuantity" />
            </x-form.group>
        @endif

        <div class="mt-4">
            @if(!auth()->check())
                <x-button variety="primary" x-on:click.prevent="$dispatch('open-dialog', 'login')">Log In Now</x-button>
            @elseif(auth()->check() && !auth()->user()->isCustomer())
                <x-button.link href="{{ route('admin.dashboard') }}" variety="secondary">Dashboard</x-button.link>
            @else
                @if($accommodation->type === \App\Enums\AccommodationType::Gym)
                    <x-button variety="primary">
                        @if(auth()->user()->activeMembershipFor($accommodation))
                            {{ auth()->user()->membershipStatusFor($accommodation) }}
                        @else
                            Join Membership
                        @endif
                        <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="join"></i>
                    </x-button>
                @else
                    <x-button variety="primary">
                        Book Now
                        <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="book"></i>
                    </x-button>
                @endif
            @endif
        </div>
    </form>
</div>
