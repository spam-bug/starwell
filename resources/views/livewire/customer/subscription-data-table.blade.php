<div>
    <div class="pb-4 border-b border-gray-300 flex items-center gap-4 text-lg">
        <label for="active" class="cursor-pointer {{ $status === 'active' ? 'text-gray-900 font-medium' : 'text-gray-500' }}">
            <input type="radio" wire:model.live="status" value="active" id="active" class="hidden" />
            Active
        </label>

        <label for="ongoing" class="cursor-pointer {{ $status === 'ongoing' ? 'text-gray-900 font-medium' : 'text-gray-500' }}">
            <input type="radio" wire:model.live="status" value="ongoing" id="ongoing" class="hidden" />
            On Going
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
                
                @if($status !== 'ongoing')
                    <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Price</th>
                @endif

                @if($status === 'ongoing')
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Start Date</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">End Date</th>
                @endif

                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Subscription Status</th>

                @if($status === 'active')
                    <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Payment Status</th>
                @endif

                @if($status !== 'cancelled')
                    <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Action</th>    
                @endif
            </tr>
            </thead>

            <tbody class="divide-y divide-gray-300">
            @if($subscriptions->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
                </tr>
            @else
                @foreach($subscriptions as $subscription)
                    <tr class="hover:bg-gray-50 cursor-pointer">
                        <td class="p-4 text-left capitalize font-medium">{{ $subscription->accommodation->name }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $subscription->accommodation->type }}</td>

                        @if($status !== 'ongoing')
                            <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                                {{ $subscription->accommodation->price() }}
                            </td>
                        @endif

                        @if($status === 'ongoing')
                            <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($subscription->start_date)->format('M d, Y') }}
                            </td>

                            <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($subscription->end_date)->format('M d, Y') }}
                            </td>
                        @endif

                        <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                            <span class="{{ $subscription->status->getStatusClass() }} px-2 py-1 rounded font-medium text-xs">
                                {{ str_replace('_', ' ', $subscription->status->value) }}
                            </span>
                        </td>

                        @if($status === 'active')
                            <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                                <span class="{{ $subscription->monthly_payment_status->getStatusClass() }} px-2 py-1 rounded font-medium text-xs">
                                    {{ str_replace('_', ' ', $subscription->monthly_payment_status->value) }}
                                </span>
                            </td>
                        @endif

                        @if($status !== 'cancelled')
                            <td class="p-4">
                                <x-button variety="secondary" wire:click.prevent="cancel({{ $subscription->id }})">Cancel</x-button>

                                @if($subscription->monthly_payment_status === \App\Enums\MembershipMonthlyPaymentStatus::toPay)
                                    <x-button variety="primary" x-on:click.prevent="$dispatch('subscribe-payment', [{{ $subscription }}])">Pay Now</x-button>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
