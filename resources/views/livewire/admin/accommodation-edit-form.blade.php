<div class="w-full bg-white border border-gray-300 rounded mt-8 overflow-hidden">
    <div class="p-4 border-b border-gray-300 bg-gray-50 flex items-center justify-between">
        <p class="text-lg font-medium">Edit {{ $form->accommodation->name }}</p>

        <livewire:admin.accommodation-delete :accommodation="$form->accommodation" />
    </div>

    <form wire:submit="save" class="p-6">
        <x-form.group>
            <x-form.label for="service" required>Service</x-form.label>
            <x-form.select wire:model="form.service">
                @foreach(\App\Enums\AccommodationType::cases() as $case)
                    <option value="{{ $case->value }}">{{ $case->name }}</option>
                @endforeach
            </x-form.select>
            <x-form.error for="form.service" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="name" required>Name</x-form.label>
            <x-form.input type="text" id="name" wire:model.blur="form.name" />
            <x-form.error for="form.name" />
        </x-form.group>

        <div class="h-[180px]">
            <x-form.label for="photo" required>Photo</x-form.label>
            <div class="flex items-end gap-4">
                <div class="w-32 h-32 rounded bg-gray-100 flex items-center justify-center overflow-hidden relative">
                    @if($form->photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                        <img src="{{ $form->photo->temporaryUrl() }}" alt="{{ $form->accommodation->name }} Photo" class="w-full h-full object-cover object-center">
                    @elseif(is_string($form->photo))
                        <img src="{{ asset($form->photo) }}" alt="{{ $form->accommodation->name }} Photo">
                        <div wire:loading.flex wire:target="form.photo" class="w-full h-full absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-black/25 flex items-center justify-center">
                            <i class="fa-solid fa-spinner animate-spin text-gray-300 text-5xl"></i>
                        </div>
                    @else
                        <i class="fa-solid fa-image text-gray-300 text-5xl" wire:loading.remove wire:target="form.photo"></i>
                        <i class="fa-solid fa-spinner animate-spin text-gray-300 text-5xl" wire:loading wire:target="form.photo"></i>
                    @endif
                </div>

                <div class="h-32 flex flex-col justify-between">
                    <div class="text-sm text-gray-500">
                        <p>Image Type: PNG, JPG, JPEG</p>
                        <p>Image Ratio: 1x1</p>
                        <p>Image File Size: 2MB</p>
                    </div>

                    <div class="flex gap-2">
                        @if($form->photo)
                            <x-button variety="secondary" wire:click.prevent="remove">Remove</x-button>
                        @endif
                        <input
                            type="file"
                            class="file:mr-4 file:py-2 file:px-4 file:rounded file:border file:border-gray-900 file:bg-gray-900 file:text-white file:font-sans"
                            accept="image/jpeg,image/png"
                            wire:model="form.photo"
                        />
                    </div>
                </div>
            </div>
            <x-form.error for="form.photo" />
        </div>

        <div class="h-[200px]">
            <x-form.label for="description" required>Description</x-form.label>
            <x-form.textarea wire:model.blur="form.description" id="description"></x-form.textarea>
            <x-form.error for="form.description" />
        </div>

        <x-form.group>
            <x-form.label for="price" required>Price</x-form.label>
            <div class="relative">
                <span class="absolute top-1/2 -translate-y-1/2 left-4 text-gray-500">₱</span>
                <x-form.input type="text" id="price" x-mask:dynamic="$money($input)" class="pl-8" wire:model.blur="form.price" />
            </div>
            <x-form.error for="form.price" />
        </x-form.group>

        <x-form.group>
            <x-form.label for="max-person" required>Max Person</x-form.label>
            <x-form.input type="number" id="max-person" wire:model.blur="form.maxPerson" />
            <x-form.error for="form.maxPerson" />
        </x-form.group>

        <div class="flex gap-2 justify-end">
            <x-button.link href="{{ route('admin.accommodations') }}" wire:navigate variety="secondary">Cancel</x-button.link>
            <x-button variety="primary" wire:loading.attr="disabled" wire:target="save">
                Save
                <i class="fa-solid fa-spinner animate-spin" wire:loading wire:target="save"></i>
            </x-button>
        </div>
    </form>
</div>
