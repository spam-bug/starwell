<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ config('app.name') }}</title>

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body
    class="min-h-screen bg-gray-100 font-sans antialiased"
    x-data="{ open: window.innerWidth > 992 }"
    x-on:resize.window="open = window.innerWidth > 992"
>
    <x-toasts />

    <header class="sticky inset-0 flex w-full items-center justify-between bg-gray-900 px-4 py-2">
        <a href="#" class="text-2xl font-bold text-white">STARWELL</a>

        <button class="text-white lg:hidden" x-on:click="open = ! open">
            <i class="fa-solid fa-bars"></i>
        </button>
    </header>

    <div class="fixed inset-0 z-50 mt-12 h-[calc(100vh-48px)] w-64 -translate-x-full overflow-y-auto border-r border-gray-300 bg-white transition-transform duration-300 ease-in-out lg:translate-x-0"
        x-bind:class="{ 'translate-x-0': open }"
    >
        <div class="flex gap-2 p-4">
            <div class="h-10 w-10 overflow-hidden rounded-full">
                <img src="https://api.dicebear.com/7.x/adventurer-neutral/svg?seed={{ auth()->user()->name }}" alt="profile photo">
            </div>

            <div>
                <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                <small class="text-gray-500">{{ auth()->user()->account_type }}</small>
            </div>
        </div>

        <div class="mt-4">
            <p class="px-4 py-2 text-xs text-gray-500">MENU</p>

            <nav>
                <a
                    href="{{ route('admin.dashboard') }}"
                    wire:navigate
                    class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a
                    href="{{ route('admin.accommodations') }}"
                    wire:navigate
                    class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    <i class="fa-solid fa-star"></i>
                    <span>Accommodations</span>
                </a>

                <div x-data="{ expanded: false }">
                    <button x-on:click="expanded = !expanded"
                        class="flex w-full items-center justify-between gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                    >
                        <div>
                            <i class="fa-solid fa-box"></i>
                            <span>Equipments</span>
                        </div>

                        <i class="fa-solid fa-chevron-down transition-transform duration-300 ease-in-out"
                            x-bind:class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <div
                        x-show="expanded"
                        x-collapse
                        x-on:click.outside="expanded = false"
                    >
                        <a
                            href="{{ route('admin.products') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>List</span>
                        </a>

                        <a
                            href="{{ route('admin.products.inventories') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Inventory</span>
                        </a>
                    </div>
                </div>

                <div x-data="{ expanded: false }">
                    <button x-on:click="expanded = !expanded"
                        class="flex w-full items-center justify-between gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                    >
                        <div>
                            <i class="fa-solid fa-server"></i>
                            <span>Reservations</span>
                        </div>

                        <i class="fa-solid fa-chevron-down transition-transform duration-300 ease-in-out"
                            x-bind:class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <div
                        x-show="expanded"
                        x-collapse
                        x-on:click.outside="expanded = false"
                    >
                        <a
                            href="{{ route('admin.reservations.pending') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Pending</span>
                        </a>

                        <a
                            href="{{ route('admin.reservations.paid') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Paid</span>
                        </a>

                        <a
                            href="{{ route('admin.reservations.reserved') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Reserved</span>
                        </a>

                        <a
                            href="{{ route('admin.reservations.cancelled') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Cancelled</span>
                        </a>
                    </div>
                </div>

                <div x-data="{ expanded: false }">
                    <button x-on:click="expanded = !expanded"
                        class="flex w-full items-center justify-between gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                    >
                        <div>
                            <i class="fa-solid fa-bolt-lightning"></i>
                            <span>Subscriptions</span>
                        </div>

                        <i class="fa-solid fa-chevron-down transition-transform duration-300 ease-in-out"
                            x-bind:class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <div
                        x-show="expanded"
                        x-collapse
                        x-on:click.outside="expanded = false"
                    >
                        <a
                            href="{{ route('admin.subscriptions.pending') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Pending</span>
                        </a>

                        <a
                            href="{{ route('admin.subscriptions.active') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Active</span>
                        </a>

                        <a
                            href="{{ route('admin.subscriptions.cancelled') }}"
                            wire:navigate
                            class="flex w-full items-center gap-2 py-2.5 pl-10 pr-4 text-sm text-gray-700 hover:bg-gray-50"
                        >
                            <span>Cancelled</span>
                        </a>
                    </div>
                </div>

                <a
                    href="{{ route('admin.customers') }}"
                    wire:navigate
                    class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    <i class="fa-solid fa-user"></i>
                    <span>Customers</span>
                </a>

                <a
                    href="{{ route('admin.staffs') }}"
                    wire:navigate
                    class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    <i class="fa-solid fa-user"></i>
                    <span>Staff</span>
                </a>

                <a
                    href="{{ route('admin.reports') }}"
                    wire:navigate
                    class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50"
                >
                    <i class="fa-solid fa-file"></i>
                    <span>Reports</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="flex w-full items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Log Out</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <main class="lg:ml-64">
        <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>

</html>
