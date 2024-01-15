<div>
    <button wire:click="$dispatch('open-dialog', '{{ $identifier }}')"
        class="block w-full whitespace-nowrap px-4 py-2.5 text-left text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:text-center lg:hover:bg-transparent"
    >LOG IN</button>

    <x-dialog title="Log In" :$identifier>
        @error('login')
            <div class="mb-4 rounded bg-red-100 px-4 py-2 text-red-800">
                <p>{{ $message }}</p>
            </div>
        @enderror

        <form wire:submit="attempt">
            <x-form.group>
                <x-form.label for="username" required>Username</x-form.label>
                <x-form.input
                    id="username"
                    type="text"
                    wire:model="username"
                />
                <x-form.error for="username" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="password" required>Password</x-form.label>
                <x-form.input
                    id="password"
                    type="password"
                    wire:model="password"
                />
                <x-form.error for="password" />
            </x-form.group>

            <div class="flex justify-end gap-2">
                <x-button variety="secondary" wire:click.prevent="cancel">Cancel</x-button>
                <x-button variety="primary">
                    Log In
                    <i
                        class="fa-solid fa-spinner animate-spin"
                        wire:loading
                        wire:target="attempt"
                    ></i>
                </x-button>
            </div>
        </form>
    </x-dialog>
</div>
