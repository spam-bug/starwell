<div class="w-full bg-white mt-8 border border-gray-300">
    <div class="w-full flex justify-end p-4">

        <x-button.link href="{{ route('admin.products.inventories.create') }}" wire:navigate variety="primary">
            <i class="fa-solid fa-plus"></i>
            <span>Add Record</span>
        </x-button.link>
    </div>

    <table class="w-full">
        <thead>
        <tr class="bg-gray-100 border-y border-gray-300">
            <th class="text-left text-sm font-medium px-4 py-2">Product Name</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Rented Quantity</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Return Quantity</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Damage Quantity</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Customer Name</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Customer ID Type</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Customer ID Number</th>
            <th class="text-right text-sm font-medium px-4 py-2">Actions</th>
        </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
        @if($inventories->isEmpty())
            <tr>
                <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
            </tr>
        @else
            @foreach($inventories as $inventory)
                <tr class="hover:bg-gray-50 cursor-pointer">
                    <td class="p-4 text-left capitalize font-medium">{{ $inventory->product->name }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $inventory->rented_quantity }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $inventory->return_quantity }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $inventory->damage_quantity }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $inventory->customer_name }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $inventory->customer_id }} </td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700 whitespace-nowrap">{{ $inventory->customer_id_number }}</td>
                    <td class="p-4 text-right text-gray-700">
                        @if($inventory->status === 'rented')
                            <x-button.link href="{{ route('admin.products.inventories.edit', $inventory) }}" wire:navigate variety="secondary">Edit</x-button.link>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @if($inventories->isNotEmpty())
        <div class="p-4 border-t border-gray-300">
            {{ $inventories->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>

