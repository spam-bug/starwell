<div class="w-full bg-white mt-8 border border-gray-300">
    <div class="w-full flex justify-between p-4">
        <div class="w-full max-w-2xl">
            <x-form.input type="text" wire:model.live="searchTerm" placeholder="Search staff or keyword" />
        </div>

        @admin
            <x-button.link href="{{ route('admin.staffs.create') }}" wire:navigate variety="primary">
                <i class="fa-solid fa-plus"></i>
                <span>New Staff</span>
            </x-button.link>
        @endAdmin
    </div>

    <table class="w-full">
        <thead>
            <tr class="bg-gray-100 border-y border-gray-300">
                <th class="text-left text-sm font-medium px-4 py-2">Name</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Username</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Email</th>
                <th class="hidden sm:table-cell text-left text-sm font-medium px-4 py-2">Account Type</th>
                @admin
                    <th class="text-right text-sm font-medium px-4 py-2">Actions</th>
                @endAdmin
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-300">
            @if($staffs->isEmpty())
                <tr>
                    <td class="p-4 text-center text-sm" colspan="5">No data available.</td>
                </tr>
            @else
                @foreach($staffs as $staff)
                    <tr class="hover:bg-gray-50 cursor-pointer">
                        <td class="p-4 text-left capitalize font-medium">{{ $staff->name }} {{ $staff->id === auth()->id() ? '(You)' : '' }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $staff->username }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $staff->email }}</td>
                        <td class="hidden sm:table-cell p-4 text-left text-gray-700">{{ $staff->account_type }}</td>
                        @admin
                            <td class="p-4 text-right text-gray-700">
                                @if($staff->id !== auth()->id())
                                        <x-button.link href="{{ route('admin.staffs.edit', $staff) }}" variety="secondary">Edit</x-button.link>
                                @endif
                            </td>
                        @endAdmin
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    @if($staffs->isNotEmpty())
        <div class="p-4 border-t border-gray-300">
            {{ $staffs->links('vendor.livewire.tailwind') }}
        </div>
    @endif
</div>

