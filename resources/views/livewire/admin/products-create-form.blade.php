<div class="w-full bg-white border border-gray-300 rounded mt-8 overflow-hidden">
    <div class="p-4 border-b border-gray-300 bg-gray-50">
        <p class="text-lg font-medium">New Product</p>
    </div>

    <form wire:submit="save" class="p-6" enctype="multipart/form-data">
        <x-form.group>
            <x-form.label for="name" required>Name</x-form.label>
            <x-form.input type="text" id="name" wire:model.blur="form.name" />
            <x-form.error for="form.name" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="price" required>Price</x-form.label>
            <div class="relative">
                <span class="absolute top-1/2 -translate-y-1/2 left-4 text-gray-500">₱</span>
                <x-form.input type="text" id="price" class="pl-8" wire:model.blur="form.price" />
            </div>
            <x-form.error for="form.price" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="quantity" required>Quantity</x-form.label>
            <x-form.input type="text" id="quantity" wire:model.blur="form.quantity" />
            <x-form.error for="form.quantity" />
        </x-form.group>

        <div class="flex gap-2 justify-end">
            <x-button.link href="{{ route('admin.products') }}" wire:navigate variety="secondary">Cancel</x-button.link>
            <x-button variety="primary" wire:loading.attr="disabled" wire:target="save">
                Save
                <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="save"></i>
            </x-button>
        </div>
    </form>
</div>
