<div class="w-full bg-white mt-8 border border-gray-300">
    <div class="w-full flex justify-between p-4">
        <div class="w-full max-w-2xl">
            <x-form.input type="text" wire:model.live="searchTerm" placeholder="Search products or keyword" />
        </div>

        <x-button.link href="{{ route('admin.products.create') }}" wire:navigate variety="primary">
            <i class="fa-solid fa-plus"></i>
            <span>New Products</span>
        </x-button.link>
    </div>

    <table class="w-full">
        <thead>
        <tr class="bg-gray-100 border-y border-gray-300">
            <th class="text-left text-sm font-medium px-4 py-2">Name</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Unit Cost</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Quantity</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Available</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Rented</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Damage</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Total Cost</th>
            <th class="text-right text-sm font-medium px-4 py-2">Actions</th>
        </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
        @if($products->isEmpty())
            <tr>
                <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
            </tr>
        @else
            @foreach($products as $product)
                <tr class="hover:bg-gray-50 cursor-pointer">
                    <td class="p-4 text-left capitalize font-medium">{{ $product->name }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $product->unitPrice() }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $product->quantity }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $product->available }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $product->inventories->sum('rented_quantity') }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $product->damage ?? 0 }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $product->totalCost() }} </td>
                    <td class="p-4 text-right text-gray-700">
                        <x-button.link href="{{ route('admin.products.edit', $product) }}" wire:navigate variety="secondary">Edit</x-button.link>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @if($products->isNotEmpty())
        <div class="p-4 border-t border-gray-300">
            {{ $products->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>

