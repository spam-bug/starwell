<x-guest-layout>
    <div>
        <img src="{{ Vite::image('inbg.jpg') }}" alt="">
    </div>

    <div class="w-full max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-center text-4xl">Services</h1>

        <div class="mt-8 mx-auto grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-8 lg:grid-cols-4 lg:mt-20">
            <img src="{{ Vite::image('back1.png') }}" alt="" class="w-full">
            <img src="{{ Vite::image('back2.png') }}" alt="" class="w-full">
            <img src="{{ Vite::image('back3.png') }}" alt="" class="w-full">
            <img src="{{ Vite::image('back4.png') }}" alt="" class="w-full">
        </div>
    </div>

    <div class="w-full max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-center text-4xl">Feedback</h1>

        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 flex-wrap lg:mt-20">
            <div class="bg-white rounded p-4 shadow">
                <p class="font-medium text-sm">“Experience the magic of #DiscoverHermosa and create memories that will last a lifetime."</p>
                <small class="block mt-2 text-gray-500">Jairo Ragunton</small>
            </div>

            <div class="bg-white rounded p-4 shadow">
                <p class="font-medium text-sm">
                    “super comfy, very accommodating staff, highly recommended resort and restobar... sulit ang stay with family and friends...  ?????????
                    Family-friendly.”
                </p>

                <small class="block mt-2 text-gray-500">Ricky Custodio</small>
            </div>

            <div class="bg-white rounded p-4 shadow">
                <p class="font-medium text-sm">
                    “I Love Starwell private resort bataan ????
                    LEGIT NA LEGIT ?
                    Romantic atmosphere
                    · Spacious rooms
                    · Historic building
                    · Great hotel bar
                    · Family-friendly
                    · Helpful concierge
                    · Good room service
                    · Quiet rooms
                    · Thoughtful amenities.”
                </p>
                <small class="block mt-2 text-gray-500">Cobi Siniel</small>
            </div>

            <div class="bg-white rounded p-4 shadow">
                <p class="font-medium text-sm">
                    “BOOK NOW and HAVE YOUR MOST MEMORABLE GETAWAY FROM THE CITY HERE! ENJOY THEIR WORLD CLASS AMENITIES and OUTSTANDING SERVICES!.”
                </p>

                <small class="block mt-2 text-gray-500">Sean Michael Sanchez</small>
            </div>
        </div>
    </div>
</x-guest-layout>
