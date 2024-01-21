<div class="mt-8 w-full border border-gray-300 bg-white">
    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-300 bg-gray-100">
                <th class="px-4 py-2 text-left text-sm font-medium">Reference Number</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Type</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">GCash</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Amount</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Status</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Date</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            @if ($transactions->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
                </tr>
            @else
                @foreach ($transactions as $transaction)
                    <tr class="cursor-pointer hover:bg-gray-50">
                        <td class="p-4 text-left font-medium capitalize">{{ strtoupper($transaction->id) }}</td>
                        <td class="hidden p-4 text-left text-gray-700 sm:table-cell">
                            {{ $transaction->booking()->exists() ? 'reservation' : 'subscription' }}</td>
                        <td class="hidden p-4 text-left text-gray-700 sm:table-cell">
                            @if ($transaction->gcash_reference_number)
                                {{ $transaction->gcash_reference_number }}
                            @else
                                <a
                                    href="{{ asset($transaction->gcash_receipt) }}"
                                    download
                                    class="text-blue-500 hover:underline"
                                >Receipt</a>
                            @endif
                        </td>
                        <td class="hidden p-4 text-left text-gray-700 sm:table-cell">{{ $transaction->amount() }}</td>
                        <td class="hidden p-4 text-left text-gray-700 sm:table-cell">
                            <span
                                class="{{ $transaction->status->getStatusClass() }} rounded px-2 py-1 text-xs font-medium tracking-wide">{{ $transaction->status }}</span>
                        </td>
                        <td class="hidden p-4 text-left text-gray-700 sm:table-cell">
                            {{ \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if ($transactions->isNotEmpty())
        <div class="border-t border-gray-300 p-4">
            {{ $transactions->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>
