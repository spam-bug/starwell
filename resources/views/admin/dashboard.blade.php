<x-admin-layout>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
        <div class="bg-white rounded border border-gray-200 p-4">
            <p class="text-sm font-bold text-gray-600">Booking Count</p>
            <h1 class="text-2xl font-bold">{{ $total['bookings'] }}</h1>
        </div>

        <div class="bg-white rounded border border-gray-200 p-4">
            <p class="text-sm font-bold text-gray-600">Membership Count</p>
            <h1 class="text-2xl font-bold">{{ $total['membership'] }}</h1>
        </div>

        <div class="bg-white rounded border border-gray-200 p-4">
            <p class="text-sm font-bold text-gray-600">Total Transactions</p>
            <h1 class="text-2xl font-bold">₱ {{ number_format(substr($total['transactions'], 0, -2) . '.' . substr($total['transactions'], -2), 2) }}</h1>
        </div>

        <div class="bg-white rounded border border-gray-200 p-4">
            <p class="text-sm font-bold text-gray-600">{{ ucfirst(date('F')) }} Transactions</p>
            <h1 class="text-2xl font-bold">₱ {{ number_format(substr($total['monthly'], 0, -2) . '.' . substr($total['monthly'], -2), 2) }}</h1>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 lg:gap-8">
        <div class="w-full bg-white mt-8 border border-gray-300">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-300">
                        <th class="text-left text-sm font-medium px-4 py-2">Accommodation</th>
                        <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Check In/Booking Date</th>
                        <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Amount</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                    @if($bookings->isEmpty())
                        <tr>
                            <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
                        </tr>
                    @else
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-gray-50 cursor-pointer">
                                <td class="p-4 text-left capitalize font-medium">{{ $booking->accommodation->name ?? 'other' }}</td>
                                <td class="hidden sm:table-cell p-4 text-left text-gray-700">
                                    @if($booking->checkin_date)
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

        <div class="w-full bg-white mt-8 border border-gray-300">
            <table class="w-full">
                <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="text-left text-sm font-medium px-4 py-2">Accommodation</th>
                    <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Start Date</th>
                    <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">End Date</th>
                    <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Amount</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">
                @if($memberships->isEmpty())
                    <tr>
                        <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
                    </tr>
                @else
                    @foreach($memberships as $membership)
                        <tr class="hover:bg-gray-50 cursor-pointer">
                            <td class="p-4 text-left capitalize font-medium text-sm">{{ $membership->accommodation->name ?? 'Other' }}</td>
                            <td class="hidden sm:table-cell p-4 text-left text-gray-700 text-xs">
                                {{ \Carbon\Carbon::parse($membership->start_date)->format('M d, Y h:i A') }}
                            </td>

                            <td class="hidden sm:table-cell p-4 text-left text-gray-700 text-xs">
                                {{ \Carbon\Carbon::parse($membership->end)->format('M d, Y h:i A') }}
                            </td>
                            <td class="p-4 text-left text-gray-700">{{ $membership->accommodation ? $membership->accommodation->price() : 'N/A' }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
