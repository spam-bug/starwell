<div class="w-full bg-white border border-gray-300 rounded mt-8 overflow-hidden">
    <div class="p-4 border-b border-gray-300 bg-gray-50">
        <p class="text-lg font-medium">New Record</p>
    </div>

    <form wire:submit="save" class="p-6" enctype="multipart/form-data">
        <x-form.group>
            <x-form.label for="customer_name" required>Customer Name</x-form.label>
            <x-form.input type="text" id="customer_name" wire:model.blur="form.customer_name" />
            <x-form.error for="form.customer_name" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="customer_id" required>Customer ID</x-form.label>
            <x-form.input type="text" id="customer_id" wire:model.blur="form.customer_id" />
            <x-form.error for="form.customer_id" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="customer_id_number" required>Customer ID Number</x-form.label>
            <x-form.input type="text" id="customer_id_number" wire:model.blur="form.customer_id_number" />
            <x-form.error for="form.customer_id_number" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="product" required>Product</x-form.label>
            <x-form.select wire:model="form.product" id="product">
                @forelse($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @empty
                    <option value="">No Available Products</option>
                @endforelse
            </x-form.select>
            <x-form.error for="form.product" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="quantity" required>Renting Quantity</x-form.label>
            <x-form.input type="text" id="quantity" wire:model.blur="form.quantity" />
            <x-form.error for="form.quantity" />
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
