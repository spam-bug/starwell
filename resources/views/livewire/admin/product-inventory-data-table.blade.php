<div class="mt-8 w-full border border-gray-300 bg-white">
    <div class="flex w-full justify-end p-4">

        <x-button.link
            href="{{ route('admin.products.inventories.create') }}"
            wire:navigate
            variety="primary"
        >
            <i class="fa-solid fa-plus"></i>
            <span>Add Record</span>
        </x-button.link>
    </div>

    <table class="w-full">
        <thead>
            <tr class="border-y border-gray-300 bg-gray-100">
                <th class="px-4 py-2 text-left text-sm font-medium">Equipment Name</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Rented Quantity</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Return Quantity</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Damage Quantity</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Customer Name</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Customer ID Type</th>
                <th class="hidden px-4 py-2 text-left text-sm font-medium sm:table-cell">Customer ID Number</th>
                <th class="px-4 py-2 text-right text-sm font-medium">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            @if ($inventories->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="7">No data available.</td>
                </tr>
            @else
                @foreach ($inventories as $inventory)
                    <tr class="cursor-pointer hover:bg-gray-50">
                        <td class="p-4 text-left font-medium capitalize">{{ $inventory->product->name }}</td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $inventory->rented_quantity }}</td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $inventory->return_quantity }} </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $inventory->damage_quantity }} </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $inventory->customer_name }} </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $inventory->customer_id }} </td>
                        <td class="hidden whitespace-nowrap p-4 text-left text-gray-700 sm:table-cell">{{ $inventory->customer_id_number }}</td>
                        <td class="p-4 text-right text-gray-700">
                            @if ($inventory->status === 'rented')
                                <x-button.link
                                    href="{{ route('admin.products.inventories.edit', $inventory) }}"
                                    wire:navigate
                                    variety="secondary"
                                >Edit</x-button.link>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if ($inventories->isNotEmpty())
        <div class="border-t border-gray-300 p-4">
            {{ $inventories->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>
