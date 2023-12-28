<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body
    class="min-h-screen font-sans antialiased bg-gray-100"
    x-data="{ expanded: window.innerWidth > 992 }"
    x-on:resize.window="expanded = window.innerWidth > 992"
>
    <x-toasts />

    <header class="bg-gray-900 relative">
        <div class="w-full max-w-7xl p-4 sm:px-6 lg:px-8 mx-auto">
            <div class="flex items-center justify-between">
                <div class="w-full flex items-center gap-8">
                    <a href="#" class="font-bold text-2xl text-white">STARWELL</a>

                    <div
                        x-show="expanded"
                        x-collapse
                        x-cloak
                        class="w-full absolute top-full inset-x-0 bg-gray-900 lg:static lg:flex lg:justify-between lg:items-center"
                    >
                        <div class="lg:flex lg:items-center lg:gap-8">
                            <a href="{{ route('home') }}" wire:navigate class="w-full block text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">HOME</a>
                            <a href="{{ route('accommodations') }}" wire:navigate class="w-full block text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">ACCOMMODATIONS</a>

                            @if(auth()->check() && auth()->user()->isCustomer())
                                <a href="{{ route('bookings', auth()->user()) }}" wire:navigate class="w-full block text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">BOOKINGS</a>
                                <a href="{{ route('subscriptions', auth()->user()) }}" wire:navigate class="w-full block text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">SUBSCRIPTIONS</a>
                            @endif

                            <a class="w-full block text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">GALLERY</a>
                            <a class="w-full block text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">ABOUT</a>
                        </div>

                        @guest
                            <div class="lg:flex lg:items-center lg:gap-4">
                                <livewire:login />
                                <span class="hidden lg:inline-block text-white">|</span>
                                <livewire:register />
                            </div>
                        @endguest

                        @if(auth()->check() && auth()->user()->isCustomer())
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button class="w-full block text-left text-white text-sm px-4 py-2.5 hover:bg-gray-800 lg:hover:bg-transparent lg:p-0 lg:inline-block">
                                    LOG OUT
                                </button>
                            </form>
                        @endif
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

    @livewireScripts
</body>
</html>
