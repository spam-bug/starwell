<div class="w-full bg-white mt-8 border border-gray-300">
    <table class="w-full">
        <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="text-left text-sm font-medium px-4 py-2">Reference Number</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Type</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">GCash</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Amount</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Status</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Date</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
        @if($transactions->isEmpty())
            <tr>
                <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
            </tr>
        @else
            @foreach($transactions as $transaction)
                <tr class="hover:bg-gray-50 cursor-pointer">
                    <td class="p-4 text-left capitalize font-medium">{{ strtoupper($transaction->id) }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $transaction->booking()->exists() ? 'reservation' : 'subscription' }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">
                        @if($transaction->gcash_reference_number)
                            {{ $transaction->gcash_reference_number }}
                        @else
                            <a href="{{ asset($transaction->gcash_receipt) }}" download class="text-blue-500 hover:underline">Receipt</a>
                        @endif
                    </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $transaction->amount() }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">
                        <span class="{{ $transaction->status->getStatusClass() }} px-2 py-1 rounded text-xs font-medium tracking-wide">{{ $transaction->status }}</span>
                    </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @if($transactions->isNotEmpty())
        <div class="p-4 border-t border-gray-300">
            {{ $transactions->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>

