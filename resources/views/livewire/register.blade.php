<div>
    <button wire:click="$dispatch('open-dialog', '{{ $identifier }}')" class="w-full block text-white text-sm px-4 py-2.5 whitespace-nowrap hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">REGISTER</button>

    <x-dialog title="Register" :$identifier>
        @error('login')
            <div class="bg-red-100 mb-4 px-4 py-2 rounded text-red-800">
                <p>$message</p>
            </div>
        @enderror

        <form wire:submit="register">
            <x-form.group>
                <x-form.label for="name" required>Name</x-form.label>
                <x-form.input type="text" id="name" wire:model="form.name" />
                <x-form.error for="form.name" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="username" required>Username</x-form.label>
                <x-form.input type="text" id="username" wire:model="form.username" />
                <x-form.error for="form.username" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="email" required>Email</x-form.label>
                <x-form.input type="email" id="email" wire:model="form.email" />
                <x-form.error for="form.email" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="password" required>Password</x-form.label>
                <x-form.input type="password" id="password" wire:model="form.password" />
                <x-form.error for="form.password" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="address" required>Address</x-form.label>
                <x-form.input type="text" id="address" wire:model="form.address" />
                <x-form.error for="form.address" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="contactNumber" required>Contact Number</x-form.label>
                <x-form.input type="text" id="contactNumber" wire:model="form.contactNumber" />
                <x-form.error for="form.contactNumber" />
            </x-form.group>

            <div class="flex justify-end gap-2">
                <x-button variety="secondary" wire:click.prevent="cancel">Cancel</x-button>
                <x-button variety="primary">
                    Register
                    <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="register"></i>
                </x-button>
            </div>
        </form>
    </x-dialog>
</div>
