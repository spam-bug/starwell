<div>
    @if($transaction)
    <x-dialog :title="$membership->accommodation->name ?? ''" :$identifier>
        @if ($membership)
            <div class="pb-4 border-b border-gray-300 border-dashed">
                <div class="flex items-center justify-between">
                    <p class="font-medium">Service Type</p>
                    <p>{{ $membership->accommodation->type ?? 'Other' }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Transaction Number</p>
                    <p>{{ strtoupper($transaction->id) }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Transaction Date</p>
                    <p>{{ \Carbon\Carbon::parse($transaction->created_at)->format('F d, Y') }}</p>
                </div>
            </div>

            <div class="mt-4 pb-4 border-b border-gray-300 border-dashed">
                @if ($transaction->gcash_reference_number)
                    <div class="flex items-center justify-between">
                        <p class="font-medium">GCash Reference Number</p>
                        <p>{{ $transaction->gcash_reference_number }}</p>
                    </div>
                @endif

                @if ($transaction->gcash_receipt)
                    <div class="flex items-center justify-between">
                        <p class="font-medium">GCash Receipt</p>
                        <a href="{{ asset($transaction->gcash_receipt) }}" download>
                            <i class="fa-solid fa-download"></i>
                        </a>
                    </div>
                @endif
            </div>

            <div class="mt-4 pb-4 border-b border-gray-300 border-dashed">
                <div class="flex items-center justify-between">
                    <p class="font-medium">Client Name</p>
                    <p>{{ $membership->user->name }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Client Address</p>
                    <p>{{ $membership->user->address }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Client Contact Number</p>
                    <p>{{ $membership->user->contact_number }}</p>
                </div>
            </div>

            <div class="mt-8">
                <div class="flex items-center justify-between border-b border-gray-300 border-dashed pb-2">
                    <p class="font-medium">Accommodation Price</p>
                    <p>{{ $membership->accommodation ? $membership->accommodation->price() : 'N/A' }}</p>
                </div>

                <div class="flex items-center justify-between border-b border-gray-300 border-dashed mt-2 pb-2">
                    <p class="font-medium">Total Amount</p>
                    <p>{{ $membership->accommodation ? $membership->accommodation->price() : 'N/A' }}</p>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-8 ">
                <x-button variety="secondary" x-on:click.prevent="$dispatch('close-dialog')">Close</x-button>
                <x-button variety="primary" wire:click="confirm">Confirm</x-button>
            </div>
        @endif
    </x-dialog>
    @endif
</div>
