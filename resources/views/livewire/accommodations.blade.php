<div class="w-full max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <div class="bg-white rounded border border-gray-300 p-4 flex flex-col lg:flex-row gap-2">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex items-center justify-between gap-2">
                <x-form.label for="type" class="whitespace-nowrap">Service Type</x-form.label>
                <x-form.select wire:model.live="type" class="min-w-[200px]">
                    <option value="">All</option>
                    @foreach(\App\Enums\AccommodationType::cases() as $case)
                        <option value="{{ $case->value }}">{{ $case->name }}</option>
                    @endforeach
                </x-form.select>
            </div>

            <div class="flex items-center justify-between gap-2">
                <x-form.label for="max-person" class="whitespace-nowrap">Max Person</x-form.label>
                <x-form.select class="min-w-[100px]" id="max-person" wire:model.live="maxPerson">
                    <option value="0">All</option>
                    @if(! empty($maxPersonChoices))
                        @foreach($maxPersonChoices as $maxPerson)
                            <option value="{{ $maxPerson }}">{{ $maxPerson }}</option>
                        @endforeach
                    @endif
                </x-form.select>
            </div>

            @if(!empty($type))
                @if(\App\Enums\AccommodationType::from($type) === \App\Enums\AccommodationType::Resort)
                    <div class="flex items-center justify-between gap-2">
                        <x-form.label for="checkin_date" class="whitespace-nowrap">Check In Date</x-form.label>
                        <x-form.input type="date" />
                    </div>

                    <div class="flex items-center justify-between gap-2">
                        <x-form.label for="checkout_date" class="whitespace-nowrap">Check Out Date</x-form.label>
                        <x-form.input type="date" />
                    </div>
                @elseif(\App\Enums\AccommodationType::from($type) === \App\Enums\AccommodationType::Barbershop || \App\Enums\AccommodationType::from($type) === \App\Enums\AccommodationType::Restobar)
                    <div class="flex items-center justify-between gap-2">
                        <x-form.label for="booking_date" class="whitespace-nowrap">Booking Date</x-form.label>
                        <x-form.input type="date" />
                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-5 gap-4 mt-8">
        @if($accommodations->isEmpty())
            <p class="col-span-2 sm:col-span-4 lg:col-span-5 w-full text-center text-sm text-gray-500">No Available Accommodations</p>
        @else
            @foreach($accommodations as $accommodation)
                <a href="{{ route('accommodations.show', $accommodation) }}" class="flex flex-col bg-white p-4 border border-gray-300 rounded">
                    <div class="w-full rounded overflow-hidden">
                        <img src="{{ asset($accommodation->photo) }}" alt="{{ $accommodation->name }} Photo">
                    </div>

                    <div class="mt-2 flex-1 flex flex-col justify-between">
                        <div>
                            <x-badge variety="info">{{ $accommodation->type }}</x-badge>
                            <h6 class="font-medium text-sm line-clamp-1 mt-2">{{ $accommodation->name }}</h6>
                            @if($accommodation->type === \App\Enums\AccommodationType::Resort || $accommodation->type === \App\Enums\AccommodationType::Restobar)
                                <p class="text-sm text-gray-500 mt-1">{{ $accommodation->max_person }} Max Persons</p>
                            @elseif($accommodation->type === \App\Enums\AccommodationType::Barbershop)
                                <p class="text-sm text-gray-500 mt-1">{{ $accommodation->max_daily_capacity }} Daily Capacity</p>
                            @endif
                        </div>

                        <p class="text-right text-xl font-bold mt-2 text-blue-600">
                            {{ $accommodation->price() }}
                        </p>
                    </div>
                </a>
            @endforeach
        @endif
    </div>

    @if($accommodations->count() < $totalAccommodations)
        <div class="w-full flex justify-center mt-8">
            <x-button variety="secondary" wire:click="loadMore">
                Load More
                <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="loadMore"></i>
            </x-button>
        </div>
    @endif
</div>
