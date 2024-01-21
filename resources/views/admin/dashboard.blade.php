<x-admin-layout>
    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4 lg:gap-8">
        <div class="rounded border border-gray-200 bg-white p-4">
            <p class="text-sm font-bold text-gray-600">Booking Count</p>
            <h1 class="mt-2 text-2xl font-bold">{{ $total['bookings'] }}</h1>
        </div>

        <div class="rounded border border-gray-200 bg-white p-4">
            <p class="text-sm font-bold text-gray-600">Membership Count</p>
            <h1 class="mt-2 text-2xl font-bold">{{ $total['membership'] }}</h1>
        </div>

        <livewire:admin.transactions-total />

        <div class="rounded border border-gray-200 bg-white p-4">
            <p class="text-sm font-bold text-gray-600">{{ ucfirst(date('F')) }} Transactions</p>
            <h1 class="mt-2 text-2xl font-bold">₱ {{ number_format(substr($total['monthly'], 0, -2) . '.' . substr($total['monthly'], -2), 2) }}</h1>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 lg:gap-8">
        <div class="mt-8 w-full border border-gray-300 bg-white">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-300 bg-gray-100">
                        <th class="px-4 py-2 text-left text-sm font-medium">Accommodation</th>
                        <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Check In/Booking Date</th>
                        <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Amount</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @if ($bookings->isEmpty())
                        <tr>
                            <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
                        </tr>
                    @else
                        @foreach ($bookings as $booking)
                            <tr class="cursor-pointer hover:bg-gray-50">
                                <td class="p-4 text-left font-medium capitalize">{{ $booking->accommodation->name ?? 'other' }}</td>
                                <td class="hidden p-4 text-left text-gray-700 sm:table-cell">
                                    @if ($booking->checkin_date)
                                        {{ \Carbon\Carbon::parse($booking->checkin_date)->format('M d, Y h:i A') }}
                                    @else
                                        {{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y h:i A') }}
                                    @endif
                                </td>
                                <td class="p-4 text-left text-gray-700">{{ $booking->amount() }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-8 w-full border border-gray-300 bg-white">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-300 bg-gray-100">
                        <th class="px-4 py-2 text-left text-sm font-medium">Accommodation</th>
                        <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Start Date</th>
                        <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">End Date</th>
                        <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Amount</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @if ($memberships->isEmpty())
                        <tr>
                            <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
                        </tr>
                    @else
                        @foreach ($memberships as $membership)
                            <tr class="cursor-pointer hover:bg-gray-50">
                                <td class="p-4 text-left text-sm font-medium capitalize">{{ $membership->accommodation->name ?? 'Other' }}</td>
                                <td class="hidden p-4 text-left text-xs text-gray-700 sm:table-cell">
                                    {{ \Carbon\Carbon::parse($membership->start_date)->format('M d, Y h:i A') }}
                                </td>

                                <td class="hidden p-4 text-left text-xs text-gray-700 sm:table-cell">
                                    {{ \Carbon\Carbon::parse($membership->end)->format('M d, Y h:i A') }}
                                </td>
                                <td class="p-4 text-left text-gray-700">
                                    {{ $membership->accommodation ? $membership->accommodation->price() : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
