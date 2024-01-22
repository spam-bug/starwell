<div class="mt-8 w-full overflow-hidden rounded border border-gray-300 bg-white">
    <div class="flex items-center justify-between border-b border-gray-300 bg-gray-50 p-4">
        <p class="text-lg font-medium">Edit {{ $form->product->name }}</p>

        <livewire:admin.product-delete :product="$form->product" />
    </div>

    <form wire:submit="save" class="p-6">
        <x-form.group>
            <x-form.label for="name" required>Name</x-form.label>
            <x-form.select wire:model="form.business">
                @foreach (\App\Enums\AccommodationType::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.error for="form.name" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="name" required>Name</x-form.label>
            <x-form.input
                id="name"
                type="text"
                wire:model.blur="form.name"
            />
            <x-form.error for="form.name" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="price" required>Price</x-form.label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">₱</span>
                <x-form.input
                    id="price"
                    type="text"
                    class="pl-8"
                    wire:model.blur="form.price"
                />
            </div>
            <x-form.error for="form.price" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="quantity" required>Quantity</x-form.label>
            <x-form.input
                id="quantity"
                type="text"
                wire:model.blur="form.quantity"
            />
            <x-form.error for="form.quantity" />
        </x-form.group>

        <div class="flex justify-end gap-2">
            <x-button.link
                href="{{ route('admin.products') }}"
                wire:navigate
                variety="secondary"
            >Cancel</x-button.link>
            <x-button
                variety="primary"
                wire:loading.attr="disabled"
                wire:target="save"
            >
                Save
                <i
                    class="fa-solid fa-spinner animate-spin"
                    wire:loading
                    wire:target="save"
                ></i>
            </x-button>
        </div>
    </form>
</div>
