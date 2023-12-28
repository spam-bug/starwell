<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    class="min-h-screen bg-gray-100 font-sans antialiased"
    x-data="{ open: window.innerWidth > 992 }"
    x-on:resize.window="open = window.innerWidth > 992"
>
    <x-toasts />

    <header class="sticky inset-0 w-full flex items-center justify-between bg-gray-900 px-4 py-2">
        <a href="#" class="font-bold text-2xl text-white">STARWELL</a>

        <button class="text-white lg:hidden" x-on:click="open = ! open">
            <i class="fa-solid fa-bars"></i>
        </button>
    </header>

    <div
        class="w-64 h-[calc(100vh-48px)] fixed inset-0 z-50 mt-12 bg-white border-r border-gray-300 -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto"
        x-bind:class="{ 'translate-x-0': open }"
    >
        <div class="flex gap-2 p-4">
            <div class="w-10 h-10 rounded-full overflow-hidden">
                <img src="https://api.dicebear.com/7.x/adventurer-neutral/svg?seed={{ auth()->user()->name }}" alt="profile photo">
            </div>

            <div>
                <p class="font-medium text-sm">{{ auth()->user()->name }}</p>
                <small class="text-gray-500">{{ auth()->user()->account_type }}</small>
            </div>
        </div>

        <div class="mt-4">
            <p class="text-xs text-gray-500 px-4 py-2">MENU</p>

            <nav>
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.accommodations') }}" wire:navigate class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-star"></i>
                    <span>Accommodations</span>
                </a>

                <a href="#" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-tag"></i>
                    <span>Products</span>
                </a>

                <a href="#" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-regular fa-image"></i>
                    <span>Gallery</span>
                </a>

                <div x-data="{ expanded: false }">
                    <button x-on:click="expanded = !expanded" class="w-full flex items-center justify-between gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                        <div>
                            <i class="fa-solid fa-server"></i>
                            <span>Reservations</span>
                        </div>

                        <i class="fa-solid fa-chevron-down transition-transform duration-300 ease-in-out" x-bind:class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <div x-show="expanded" x-collapse x-on:click.outside="expanded = false">
                        <a href="{{ route('admin.reservations.pending') }}" wire:navigate class="w-full flex items-center gap-2 pl-10 pr-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <span>Pending</span>
                        </a>

                        <a href="{{ route('admin.reservations.paid') }}" wire:navigate class="w-full flex items-center gap-2 pl-10 pr-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <span>Paid</span>
                        </a>

                        <a href="{{ route('admin.reservations.reserved') }}" wire:navigate class="w-full flex items-center gap-2 pl-10 pr-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <span>Reserved</span>
                        </a>

                        <a href="{{ route('admin.reservations.cancelled') }}" wire:navigate class="w-full flex items-center gap-2 pl-10 pr-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <span>Cancelled</span>
                        </a>
                    </div>
                </div>

                <div x-data="{ expanded: false }">
                    <button x-on:click="expanded = !expanded" class="w-full flex items-center justify-between gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                        <div>
                            <i class="fa-solid fa-bolt-lightning"></i>
                            <span>Subscriptions</span>
                        </div>

                        <i class="fa-solid fa-chevron-down transition-transform duration-300 ease-in-out" x-bind:class="{ 'rotate-180': expanded }"></i>
                    </button>

                    <div x-show="expanded" x-collapse x-on:click.outside="expanded = false">
                        <a href="{{ route('admin.subscriptions.pending') }}" wire:navigate class="w-full flex items-center gap-2 pl-10 pr-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <span>Pending</span>
                        </a>

                        <a href="{{ route('admin.subscriptions.active') }}" wire:navigate class="w-full flex items-center gap-2 pl-10 pr-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <span>Active</span>
                        </a>

                        <a href="{{ route('admin.subscriptions.cancelled') }}" wire:navigate class="w-full flex items-center gap-2 pl-10 pr-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                            <span>Cancelled</span>
                        </a>
                    </div>
                </div>

                <a href="#" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-comment"></i>
                    <span>Chatbot</span>
                </a>

                <a href="{{ route('admin.customers') }}" wire:navigate class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-user"></i>
                    <span>Customers</span>
                </a>

                <a href="{{ route('admin.staffs') }}" wire:navigate class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-user"></i>
                    <span>Staff</span>
                </a>

                <a href="#" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Feedbacks</span>
                </a>

                <a href="{{ route('admin.reports') }}" wire:navigate class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fa-solid fa-file"></i>
                    <span>Reports</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Log Out</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <main class="lg:ml-64">
        <div class="w-full max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>
