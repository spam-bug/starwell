<div>
    <button wire:click="$dispatch('open-dialog', '{{ $identifier }}')"
        class="block w-full whitespace-nowrap px-4 py-2.5 text-left text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:text-center lg:hover:bg-transparent"
    >REGISTER</button>

    <x-dialog title="Register" :$identifier>
        @error('login')
            <div class="mb-4 rounded bg-red-100 px-4 py-2 text-red-800">
                <p>$message</p>
            </div>
        @enderror

        <form wire:submit="register">
            <x-form.group>
                <x-form.label for="name" required>Name</x-form.label>
                <x-form.input
                    id="name"
                    type="text"
                    wire:model="form.name"
                />
                <x-form.error for="form.name" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="username" required>Username</x-form.label>
                <x-form.input
                    id="username"
                    type="text"
                    wire:model="form.username"
                />
                <x-form.error for="form.username" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="email" required>Email</x-form.label>
                <x-form.input
                    id="email"
                    type="email"
                    wire:model="form.email"
                />
                <x-form.error for="form.email" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="password" required>Password</x-form.label>
                <x-form.input
                    id="password"
                    type="password"
                    wire:model="form.password"
                />
                <x-form.error for="form.password" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="address" required>Address</x-form.label>
                <x-form.input
                    id="address"
                    type="text"
                    wire:model="form.address"
                />
                <x-form.error for="form.address" />
            </x-form.group>

            <x-form.group>
                <x-form.label for="contactNumber" required>Contact Number</x-form.label>
                <x-form.input
                    id="contactNumber"
                    type="text"
                    wire:model="form.contactNumber"
                />
                <x-form.error for="form.contactNumber" />
            </x-form.group>

            <x-form.group>
                <label for="terms" class="block">
                    <input
                        id="terms"
                        type="checkbox"
                        wire:model="form.terms"
                    >
                    <span>I have read and agree to the <a
                            href="/terms"
                            target="_blank"
                            class="text-blue-500 hover:underline"
                        >Terms and Conditions</a></span>
                </label>
                <x-form.error for="form.terms" />
            </x-form.group>

            <div class="flex justify-end gap-2">
                <x-button variety="secondary" wire:click.prevent="cancel">Cancel</x-button>
                <x-button variety="primary">
                    Register
                    <i
                        class="fa-solid fa-spinner animate-spin"
                        wire:loading
                        wire:target="register"
                    ></i>
                </x-button>
            </div>
        </form>
    </x-dialog>
</div>
