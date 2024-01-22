<div class="mt-8 w-full border border-gray-300 bg-white">
    <div class="flex w-full justify-between p-4">
        <div class="w-full max-w-2xl">
            <x-form.input
                type="text"
                wire:model.live="searchTerm"
                placeholder="Search products or keyword"
            />
        </div>

        <x-button.link
            href="{{ route('admin.products.create') }}"
            wire:navigate
            variety="primary"
        >
            <i class="fa-solid fa-plus"></i>
            <span>New Products</span>
        </x-button.link>
    </div>

    <table class="w-full">
        <thead>
            <tr class="border-y border-gray-300 bg-gray-100">
                <th class="px-4 py-2 text-left text-sm font-medium">Business</th>
                <th class="px-4 py-2 text-left text-sm font-medium">Name</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Unit Cost</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Quantity</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Available</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Rented</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Damage</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Total Cost</th>
                <th class="px-4 py-2 text-right text-sm font-medium">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            @if ($products->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
                </tr>
            @else
                @foreach ($products as $product)
                    <tr class="cursor-pointer hover:bg-gray-50">
                        <td class="p-4 text-left font-medium capitalize">{{ $product->business }}</td>
                        <td class="p-4 text-left font-medium capitalize">{{ $product->name }}</td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $product->unitPrice() }}</td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $product->quantity }} </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $product->available }} </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">
                            {{ $product->rentedQuantity() }}
                        </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $product->damage ?? 0 }} </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $product->totalCost() }} </td>
                        <td class="p-4 text-right text-gray-700">
                            <x-button.link
                                href="{{ route('admin.products.edit', $product) }}"
                                wire:navigate
                                variety="secondary"
                            >Edit</x-button.link>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if ($products->isNotEmpty())
        <div class="border-t border-gray-300 p-4">
            {{ $products->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>
