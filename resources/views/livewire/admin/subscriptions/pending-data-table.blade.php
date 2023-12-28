<div>
    <h1 class="text-3xl font-medium">Pending Subscriptions</h1>

    <div class="text-xs flex items-center gap-1 mt-2">
        <a href="{{ route('admin.dashboard') }}" wire:navigate class="inline-flex items-center gap-1 hover:underline">
            <i class="fa-solid fa-house"></i>
            <span>Home</span>
        </a>

        <i class="fa-solid fa-chevron-right text-gray-500"></i>

        <span class="text-gray-500">Pending Subscriptions</span>
    </div>

    <div class="mt-8 bg-white border border-gray-300 rounded overflow-hidden">
        <table class="w-full">
            <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="text-left text-sm font-medium px-4 py-2">Name</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Service Type</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Amount</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Subscription Status</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Payment Status</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Action</th>
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
                        <td class="p-4 text-left capitalize font-medium">{{ $subscription->accommodation->name }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $subscription->accommodation->type }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $subscription->accommodation->price() }}</td>
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
                        <td class="p-4">
                            <x-button variety="secondary" wire:click="cancel({{ $subscription->id }})">Cancel</x-button>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>

    <livewire:admin.subscriptions.view-transaction />
</div>
