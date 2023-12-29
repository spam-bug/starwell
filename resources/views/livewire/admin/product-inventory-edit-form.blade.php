<div class="w-full bg-white border border-gray-300 rounded mt-8 overflow-hidden">
    <div class="p-4 border-b border-gray-300 bg-gray-50">
        <p class="text-lg font-medium">Return Product</p>
    </div>

    <form wire:submit="save" class="p-6" enctype="multipart/form-data">
        <x-form.group>
            <x-form.label for="return_quantity" required>Return Quantity (include damage)</x-form.label>
            <x-form.input type="text" id="return_quantity" wire:model.blur="form.return_quantity" />
            <x-form.error for="form.return_quantity" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="damage_quantity" required>Damage Quantity</x-form.label>
            <x-form.input type="text" id="damage_quantity" wire:model.blur="form.damage_quantity" />
            <x-form.error for="form.damage_quantity" />
        </x-form.group>

        <div class="flex gap-2 justify-end">
            <x-button.link href="{{ route('admin.products.inventories') }}" wire:navigate variety="secondary">Cancel</x-button.link>
            <x-button variety="primary" wire:loading.attr="disabled" wire:target="save">
                Save
                <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="save"></i>
            </x-button>
        </div>
    </form>
</div>
