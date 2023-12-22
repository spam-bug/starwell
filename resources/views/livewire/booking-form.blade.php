<div>
    <x-dialog :title="$accommodation->name ?? ''" :$identifier>
        <form wire:submit="confirm">
            <x-form.group>
                <x-form.label for="check-in">Check In</x-form.label>
                <x-form.input type="datetime-local" id="check-in" wire:model.blur="checkIn" />
                <x-form.error for="checkIn" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="check-out">Check Out</x-form.label>
                <x-form.input type="datetime-local" id="check-out" wire:model.blur="checkOut" />
                <x-form.error for="checkOut" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="person-quantity">How many person?</x-form.label>
                <x-form.input type="number" id="person-quantity" wire:model.blur="personQuantity" />
                <x-form.error for="personQuantity" />
            </x-form.group>

            <div class="flex justify-end gap-2 mt-4">
                <x-button variety="secondary" x-on:click.prevent="$dispatch('close-dialog')">Cancel</x-button>
                <x-button variety="primary">
                    Confirm
                    <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="confirm"></i>
                </x-button>
            </div>
        </form>
    </x-dialog>
</div>
