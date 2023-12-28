<div class="w-full bg-white mt-8 border border-gray-300">
    <div class="w-full flex justify-between p-4">
        <div class="w-full max-w-2xl">
            <x-form.input type="text" wire:model.live="searchTerm" placeholder="Search customer or keyword" />
        </div>
    </div>

    <table class="w-full">
        <thead>
        <tr class="bg-gray-100 border-y border-gray-300">
            <th class="text-left text-sm font-medium px-4 py-2">Name</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Username</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Email</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Address</th>
            <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Contact Number</th>
        </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
        @if($customers->isEmpty())
            <tr>
                <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
            </tr>
        @else
            @foreach($customers as $customer)
                <tr class="hover:bg-gray-50 cursor-pointer">
                    <td class="p-4 text-left capitalize font-medium">{{ $customer->name }} {{ $customer->id === auth()->id() ? '(You)' : '' }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $customer->username }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $customer->email }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $customer->address }}</td>
                    <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $customer->contact_number }}</td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @if($customers->isNotEmpty())
        <div class="p-4 border-t border-gray-300">
            {{ $customers->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>

