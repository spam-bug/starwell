<div>
    <button wire:click="$dispatch('open-dialog', '{{ $identifier }}')" class="w-full block text-white text-sm px-4 py-2.5 whitespace-nowrap hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">LOG IN</button>

    <x-dialog title="Log In" :$identifier>
        @error('login')
            <div class="bg-red-100 mb-4 px-4 py-2 rounded text-red-800">
                <p>{{ $message }}</p>
            </div>
        @enderror

        <form wire:submit="attempt">
            <x-form.group>
                <x-form.label for="username" required>Username</x-form.label>
                <x-form.input type="text" id="username" wire:model="username" />
                <x-form.error for="username" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="password" required>Password</x-form.label>
                <x-form.input type="password" id="password" wire:model="password" />
                <x-form.error for="password" />
            </x-form.group>

            <div class="flex justify-end gap-2">
                <x-button variety="secondary" wire:click.prevent="cancel">Cancel</x-button>
                <x-button variety="primary">
                    Log In
                    <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="attempt"></i>
                </x-button>
            </div>
        </form>
    </x-dialog>
</div>
