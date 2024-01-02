<div>
    <h1 class="text-3xl font-medium">Active Subscriptions</h1>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">Active Subscriptions</span>
    </div>

    <div class="mt-8 bg-white border border-gray-300 rounded overflow-hidden">
        <table class="w-full">
            <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="text-left text-sm font-medium px-4 py-2">Name</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Service Type</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Start Date</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">End Date</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Subscription Status</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Payment Status</th>
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-300">
            @if($subscriptions->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
                </tr>
            @else
                @foreach($subscriptions as $subscription)
                    <tr class="hover:bg-gray-50 cursor-pointer" x-on:click="$dispatch('view-transaction', [{{ $subscription->id }}])">
                        <td class="p-4 text-left capitalize font-medium">{{ $subscription->accommodation->name ?? 'Other' }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $subscription->accommodation->type ?? 'N/A' }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ \Carbon\Carbon::parse($subscription->start_date )->format('M d, Y') }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ \Carbon\Carbon::parse($subscription->end_date )->format('M d, Y') }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            <span class="{{ $subscription->status->getStatusClass() }} px-2 py-1 rounded font-medium text-xs">
                                {{ str_replace('_', ' ', $subscription->status->value) }}
                            </span>
                        </td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            <span class="{{ $subscription->monthly_payment_status->getStatusClass() }} px-2 py-1 rounded font-medium text-xs">
                                {{ str_replace('_', ' ', $subscription->monthly_payment_status->value) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
