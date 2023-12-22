<div class="w-full bg-white border border-gray-300 rounded mt-8 overflow-hidden">
    <div class="flex items-center justify-between p-4 border-b border-gray-300 bg-gray-50">
        <p class="text-lg font-medium">Edit {{ ucfirst($form->staff->name) }} Account</p>

        <div class="flex gap-2">
            <livewire:admin.staff-password-reset :staff="$form->staff" />
            <livewire:admin.staff-delete :staff="$form->staff" />
        </div>
    </div>

    <form wire:submit="save" class="p-6">
        <x-form.group>
            <x-form.label for="name" required>Name</x-form.label>
            <x-form.input type="text" id="name" wire:model.blur="form.name" />
            <x-form.error for="form.name" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="username" required>Username</x-form.label>
            <x-form.input type="text" id="username" wire:model.blur="form.username" />
            <x-form.error for="form.username" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="email" required>Email</x-form.label>
            <x-form.input type="email" id="email" wire:model.blur="form.email" />
            <x-form.error for="form.email" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="account_type" required>Account Type</x-form.label>
            <x-form.select wire:model.blur="form.accountType">
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </x-form.select>
            <x-form.error for="form.accountType" />
        </x-form.group>

        <div class="flex gap-2 justify-end">
            <x-button.link href="{{ route('admin.staffs') }}" wire:navigate variety="secondary">Cancel</x-button.link>
            <x-button variety="primary" wire:loading.attr="disabled" wire:target="save">
                Save
                <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="save"></i>
            </x-button>
        </div>
    </form>
</div>
