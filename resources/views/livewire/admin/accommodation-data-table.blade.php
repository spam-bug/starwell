<div class="w-full bg-white mt-8 border border-gray-300">
    <div class="w-full flex justify-between p-4">
        <div class="w-full max-w-2xl">
            <x-form.input type="text" wire:model.live="searchTerm" placeholder="Search accommodation or keyword" />
        </div>

        @admin
        <x-button.link href="{{ route('admin.accommodations.create') }}" wire:navigate variety="primary">
            <i class="fa-solid fa-plus"></i>
            <span>New Accommodation</span>
        </x-button.link>
        @endAdmin
    </div>

    <table class="w-full">
        <thead>
        <tr class="bg-gray-100 border-y border-gray-300">
            <th class="text-left text-sm font-medium px-4 py-2">Name</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Service Type</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Price</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Max Person</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Available</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Status</th>
            @admin
            <th class="text-right text-sm font-medium px-4 py-2">Actions</th>
            @endAdmin
        </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
        @if($accommodations->isEmpty())
            <tr>
                <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
            </tr>
        @else
            @foreach($accommodations as $accommodation)
                <tr class="hover:bg-gray-50 cursor-pointer">
                    <td class="p-4 text-left capitalize font-medium">
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-16 rounded overflow-hidden">
                                <img src="{{ asset($accommodation->photo) }}" alt="" class="w-full h-full object-cover object-center">
                            </div>
                            {{ $accommodation->name }}
                        </div>
                    </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $accommodation->type }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                        ₱ {{ number_format(substr($accommodation->price, 0, -2) . '.' . substr($accommodation->price, -2), 2) }}
                    </td>

                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $accommodation->max_person }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $accommodation->available_slots }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">
                        <span class="{{ $accommodation->status->getStatusClass() }} px-2 py-1 rounded text-xs font-medium tracking-wide">{{ $accommodation->status }}</span>
                    </td>
                    @admin
                    <td class="p-4 text-right text-gray-700">
                        <x-button.link href="{{ route('admin.accommodations.edit', $accommodation) }}" wire:navigate variety="secondary">Edit</x-button.link>
                    </td>
                    @endAdmin
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @if($accommodations->isNotEmpty())
        <div class="p-4 border-t border-gray-300">
            {{ $accommodations->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>

