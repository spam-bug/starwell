<div>
    <x-button variety="danger" x-on:click="$dispatch('open-dialog', '{{ $identifier }}')">Delete</x-button>

    <x-dialog title="Are you sure?" :$identifier>
        <p>
            This action is irreversible and will permanently remove the selected content.
            Please take a moment to consider the consequences for proceeding.
        </p>

        <div class="mt-4 flex justify-end gap-2">
            <x-button variety="secondary" x-on:click="$dispatch('close-dialog')">Cancel</x-button>
            <x-button variety="primary" wire:click="delete">
                Confirm
                <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="delete"></i>
            </x-button>
        </div>
    </x-dialog>
</div>
