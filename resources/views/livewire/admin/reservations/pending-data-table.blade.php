<div>
    <h1 class="text-3xl font-medium">Pending Reservations</h1>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">Pending Reservations</span>
    </div>

    <div class="mt-8 bg-white border border-gray-300 rounded overflow-hidden">
        <table class="w-full">
            <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="text-left text-sm font-medium px-4 py-2">Name</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Service Type</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Amount</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Quantity</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Down Payment</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Status</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Action</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-300">
            @if($reservations->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
                </tr>
            @else
                @foreach($reservations as $reservation)
                    <tr class="hover:bg-gray-50 cursor-pointer">
                        <td class="p-4 text-left capitalize font-medium">{{ $reservation->accommodation->name }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $reservation->accommodation->type }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            ₱ {{ number_format(substr($reservation->amount, 0, -2) . '.' . substr($reservation->amount, -2), 2) }}
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $reservation->person_quantity }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            ₱ {{ number_format(substr($reservation->amount / 2, 0, -2) . '.' . substr($reservation->amount / 2, -2), 2) }}
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            <span class="{{ $reservation->status->getStatusClass() }} px-2 py-1 rounded font-medium text-xs">
                                {{ str_replace('_', ' ', $reservation->status->value) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <x-button variety="secondary" wire:click="cancel({{ $reservation->id }})">Cancel</x-button>

                           @if($reservation->status === \App\Enums\BookingStatus::Pending)
                                <x-button variety="primary" wire:click="confirm({{ $reservation->id }})">
                                    Confirm
                                </x-button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
