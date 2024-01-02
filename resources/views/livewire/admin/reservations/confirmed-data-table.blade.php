<div>
    <h1 class="text-3xl font-medium">Confirmed Reservations</h1>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">Confirmed Reservations</span>
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
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Check In / Booking Date</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Status</th>
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
                        <td class="p-4 text-left capitalize font-medium">{{ $booking->accommodation->name ?? 'other' }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $booking->accommodation->type ?? 'N/A' }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            {{ $booking->amount() }}
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $booking->person_quantity }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            {{ $booking->downPayment() }}
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            @if($booking->checkin_date)
                                {{ \Carbon\Carbon::parse($booking->checkin_date)->format('M d, Y h:i A') }}
                            @else
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y h:i A') }}
                            @endif
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            <span class="{{ $booking->status->getStatusClass() }} px-2 py-1 rounded font-medium text-xs">
                                {{ str_replace('_', ' ', $booking->status->value) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
