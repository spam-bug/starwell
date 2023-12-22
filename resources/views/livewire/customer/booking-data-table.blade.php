<div>
    <div class="pb-4 border-b border-gray-300 flex items-center gap-4 text-lg">
        <label for="active" class="cursor-pointer {{ $status === 'active' ? 'text-gray-900 font-medium' : 'text-gray-500' }}">
            <input type="radio" wire:model.live="status" value="active" id="active" class="hidden" />
            Active
        </label>

        <label for="completed" class="cursor-pointer {{ $status === 'completed' ? 'text-gray-900 font-medium' : 'text-gray-500' }}">
            <input type="radio" wire:model.live="status" value="completed" id="completed" class="hidden" />
            Completed
        </label>

        <label for="cancelled" class="cursor-pointer {{ $status === 'cancelled' ? 'text-gray-900 font-medium' : 'text-gray-500' }}">
            <input type="radio" wire:model.live="status" value="cancelled" id="cancelled" class="hidden" />
            Cancelled
        </label>
    </div>

    <div class="mt-4 bg-white border border-gray-300 rounded overflow-hidden">
        <table class="w-full">
            <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="text-left text-sm font-medium px-4 py-2">Name</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Service Type</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Price</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Quantity</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Amount</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Status</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Action</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-300">
            @if($bookings->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
                </tr>
            @else
                @foreach($bookings as $booking)
                    <tr class="hover:bg-gray-50 cursor-pointer">
                        <td class="p-4 text-left capitalize font-medium">{{ $booking->accommodation->name }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $booking->accommodation->type }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            ₱ {{ number_format(substr($booking->accommodation->price, 0, -2) . '.' . substr($booking->accommodation->price, -2), 2) }}
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $booking->person_quantity }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            ₱ {{ number_format(substr($booking->amount, 0, -2) . '.' . substr($booking->amount, -2), 2) }}
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            <span class="{{ $booking->status->getStatusClass() }} px-2 py-1 rounded font-medium text-xs">
                                {{ str_replace('_', ' ', $booking->status->value) }}
                            </span>
                        </td>
                        <td class="p-4">
                            @if($status === 'active')
                                <x-button variety="secondary" wire:click.prevent="cancel({{ $booking->id }})">Cancel</x-button>
                            @endif

                            @if($booking->status === \App\Enums\BookingStatus::ToPay)
                                <x-button variety="primary" x-on:click.prevent="$dispatch('payment', [{{ $booking }}])">Pay Now</x-button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
