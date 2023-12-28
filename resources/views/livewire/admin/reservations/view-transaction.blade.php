<div>
    <x-dialog :title="$booking->accommodation->name ?? ''" :$identifier>
        @if ($booking)
            <div class="pb-4 border-b border-gray-300 border-dashed">
                <div class="flex items-center justify-between">
                    <p class="font-medium">Service Type</p>
                    <p>{{ $booking->accommodation->type }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Transaction Number</p>
                    <p>{{ strtoupper($booking->transaction->id) }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Transaction Date</p>
                    <p>{{ \Carbon\Carbon::parse($booking->transaction->created_at)->format('F d, Y') }}</p>
                </div>
            </div>

            <div class="mt-4 pb-4 border-b border-gray-300 border-dashed">
                @if ($booking->transaction->gcash_reference_number)
                    <div class="flex items-center justify-between">
                        <p class="font-medium">GCash Reference Number</p>
                        <p>{{ $booking->transaction->gcash_reference_number }}</p>
                    </div>
                @endif

                @if ($booking->transaction->gcash_receipt)
                    <div class="flex items-center justify-between">
                        <p class="font-medium">GCash Receipt</p>
                        <a href="{{ asset($booking->transaction->gcash_receipt) }}" download>
                            <i class="fa-solid fa-download"></i>
                        </a>
                    </div>
                @endif
            </div>

            <div class="mt-4 pb-4 border-b border-gray-300 border-dashed">
                <div class="flex items-center justify-between">
                    <p class="font-medium">Client Name</p>
                    <p>{{ $booking->client->name }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Client Address</p>
                    <p>{{ $booking->client->address }}</p>
                </div>

                <div class="flex items-center justify-between">
                    <p class="font-medium">Client Contact Number</p>
                    <p>{{ $booking->client->contact_number }}</p>
                </div>
            </div>

            <div class="mt-8">
                <div class="flex items-center justify-between border-b border-gray-300 border-dashed pb-2">
                    <p class="font-medium">Accommodation Price</p>
                    <p>{{ $booking->accommodation->price() }}</p>
                </div>

                <div class="flex items-center justify-between border-b border-gray-300 border-dashed mt-2 pb-2">
                    <p class="font-medium">Number of Person</p>
                    <p>{{ $booking->person_quantity }}</p>
                </div>

                <div class="flex items-center justify-between border-b border-gray-300 border-dashed mt-2 pb-2">
                    <p class="font-medium">Total Amount</p>
                    <p>{{ $booking->amount() }}</p>
                </div>

                <div class="flex items-center justify-between mt-2">
                    <p class="font-medium">Required Down Payment</p>
                    <p>{{ $booking->downPayment() }}</p>
                </div>
            </div>

            <div class="flex justify-end gap-2 mt-8 ">
                <x-button variety="secondary" x-on:click.prevent="$dispatch('close-dialog')">Close</x-button>
                <x-button variety="primary" wire:click="confirm({{ $booking->id }})">Confirm</x-button>
            </div>
        @endif
    </x-dialog>

</div>
