<div>
    <x-button variety="secondary" x-on:click="$dispatch('open-dialog', '{{ $identifier }}')">Password Reset</x-button>

    <x-dialog title="Reset Password" :identifier="$identifier">
        <p>An email containing the new password will be sent to <span class="text-blue-500">{{ $staff->email }}</span>.</p>

        <div class="flex justify-end gap-2 mt-4">
            <x-button variety="secondary" x-on:click="$dispatch('close-dialog')">Cancel</x-button>
            <x-button variety="primary" wire:click="resetPassword">
                Confirm
                <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="resetPassword"></i>
            </x-button>
        </div>
    </x-dialog>
</div>
