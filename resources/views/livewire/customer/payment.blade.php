<div>
    <x-dialog :$title :$identifier>
        <div class="flex flex-col justify-center items-center">
            <p class="font-medium mt-2">GCash</p>
            <img src="{{ Vite::image('gcash.jpg') }}" alt="GCash QR Code">
        </div>

        @if($booking)
            <div class="mt-4">
                <p class="font-medium">Required Down Payment: {{ $booking->downPayment() }}</p>
            </div>
        @endif

        @if($membership)
            <div class="mt-4">
                <p class="font-medium">Monthly Charged: {{ $membership->accommodation->price() }}</p>
            </div>
        @endif

        <form class="mt-4" wire:submit="confirm">
            <x-form.group>
                <x-form.label for="gcash-reference-number">GCash Reference Number</x-form.label>
                <x-form.input type="text" id="gcash-reference-number" wire:model.blur="referenceNumber" />
                <x-form.error for="referenceNumber" />
            </x-form.group>

            <div class="w-full flex gap-4 items-center text-sm mb-2">
                <div class="w-full border-t border-gray-300"></div>
                    OR
                <div class="w-full border-t border-gray-300"></div>
            </div>

            <x-form.group>
                <x-form.label for="gcash-receipt">GCash Receipt</x-form.label>
                <input
                    class="block w-full text-gray-900 border border-gray-300 rounded cursor-pointer file:p-2 file:border-0 file:bg-gray-100 file:bg-white"
                    id="gcash-receipt"
                    type="file"
                    wire:model="receipt"
                >
                <x-form.error for="receipt" />
            </x-form.group>

            <div class="flex justify-end gap-2">
                <x-button variety="secondary" x-on:click.prevent="$dispatch('close-dialog')">Cancel</x-button>
                <x-button variety="primary">
                    Confirm
                    <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="confirm"></i>
                </x-button>
            </div>
        </form>
    </x-dialog>
</div>
