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
    x-data="{ expanded: window.innerWidth > 992 }"
    x-on:resize.window="expanded = window.innerWidth > 992"
>
    <x-toasts />

    <header class="relative bg-gray-900">
        <div class="mx-auto w-full max-w-7xl p-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex w-full items-center gap-8">
                    <a href="#" class="text-2xl font-bold text-white">STARWELL</a>

                    <div
                        x-show="expanded"
                        x-collapse
                        x-cloak
                        class="absolute inset-x-0 top-full w-full bg-gray-900 lg:static lg:flex lg:items-center lg:justify-between"
                    >
                        <div class="lg:flex lg:items-center lg:gap-8">
                            <a
                                href="{{ route('home') }}"
                                wire:navigate
                                class="block w-full px-4 py-2.5 text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:hover:bg-transparent"
                            >HOME</a>
                            <a
                                href="{{ route('accommodations') }}"
                                wire:navigate
                                class="block w-full px-4 py-2.5 text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:hover:bg-transparent"
                            >ACCOMMODATIONS</a>

                            @if (auth()->check() &&
                                    auth()->user()->isCustomer())
                                <a
                                    href="{{ route('bookings', auth()->user()) }}"
                                    wire:navigate
                                    class="block w-full px-4 py-2.5 text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:hover:bg-transparent"
                                >BOOKINGS</a>
                                <a
                                    href="{{ route('subscriptions', auth()->user()) }}"
                                    wire:navigate
                                    class="block w-full px-4 py-2.5 text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:hover:bg-transparent"
                                >SUBSCRIPTIONS</a>
                            @endif

                            <a
                                href="{{ route('gallery') }}"
                                wire:navigate
                                class="block w-full px-4 py-2.5 text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:hover:bg-transparent"
                            >GALLERY</a>
                            {{--                            <a class="w-full block text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">ABOUT</a> --}}
                        </div>

                        @guest
                            <div class="lg:flex lg:items-center lg:gap-4">
                                <livewire:login />
                                <span class="hidden text-white lg:inline-block">|</span>
                                <livewire:register />
                            </div>
                        @endguest

                        @auth
                            <div class="lg:flex lg:items-center lg:gap-4">
                                @if (auth()->user()->isStaff() ||
                                        auth()->user()->isAdmin())
                                    <a
                                        href="{{ route('admin.dashboard') }}"
                                        wire:navigate
                                        class="block w-full px-4 py-2.5 text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:hover:bg-transparent"
                                    >DASHBOARD</a>
                                @endif

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button
                                        class="block w-full px-4 py-2.5 text-left text-sm text-white hover:bg-gray-800 lg:inline-block lg:p-0 lg:hover:bg-transparent"
                                    >
                                        LOG OUT
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>

                <button class="text-white lg:hidden" x-on:click="expanded = !expanded">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <main class="min-h-[calc(100vh-116px)]">
        {{ $slot }}
    </main>

    <footer class="bg-white p-4 text-center">
        <p class="text-sm text-gray-500">Copyright © 2020 All rights reserved.</p>
    </footer>

    <livewire:chatbot />
    @livewireScripts
</body>

</html>
