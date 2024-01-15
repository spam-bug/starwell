<div>
    @persist('chatbot')
        <div x-data="{ show: false, message: '' }" class="fixed bottom-0 right-10 w-64 shadow-2xl">
            <div x-on:click="show = !show" class="flex cursor-pointer items-center gap-2 rounded-t bg-gray-900 px-4 py-2 text-white">
                <i class="fa-solid fa-robot"></i>
                <p>Chat Now</p>
            </div>

            <div
                x-show="show"
                x-collapse
                x-cloak
                class="min-h-[300px] bg-white"
            >
                <div class="flex h-[260px] flex-col-reverse overflow-y-auto">
                    <div class="space-y-4 p-4">
                        @foreach ($messages as $message)
                            <div class="{{ $message['type'] === 'user' ? 'bg-blue-600 text-white ml-auto' : 'bg-gray-100' }} w-fit rounded p-2">
                                {!! $message['content'] !!}
                            </div>
                        @endforeach
                        <div
                            class="flex w-fit items-center justify-center rounded bg-gray-100 p-4"
                            wire:loading.flex
                            wire:target="sendMessage"
                        >
                            <div class="mx-1 h-2 w-2 animate-bounce rounded-full bg-gray-500"></div>
                            <div class="mx-1 h-2 w-2 animate-bounce rounded-full bg-gray-500" style="animation-delay: 0.1s;"></div>
                            <div class="mx-1 h-2 w-2 animate-bounce rounded-full bg-gray-500" style="animation-delay: 0.2s;"></div>
                        </div>
                    </div>
                </div>

                <form class="flex gap-1 overflow-auto px-4 py-2" wire:loading.remove>
                    <label for="address" class="inline-block cursor-pointer whitespace-nowrap rounded-full border border-black px-2 py-1 text-sm">
                        <input
                            id="address"
                            type="radio"
                            wire:model.live="select"
                            value="address"
                            class="sr-only"
                        >
                        address
                    </label>

                    <label for="payment" class="inline-block cursor-pointer whitespace-nowrap rounded-full border border-black px-2 py-1 text-sm">
                        <input
                            id="payment"
                            type="radio"
                            wire:model.live="select"
                            value="mode of payment"
                            class="sr-only"
                        >
                        mode of payment
                    </label>

                    <label for="accommodations" class="inline-block cursor-pointer whitespace-nowrap rounded-full border border-black px-2 py-1 text-sm">
                        <input
                            id="accommodations"
                            type="radio"
                            wire:model.live="select"
                            value="accommodations"
                            class="sr-only"
                        >
                        accommodations
                    </label>

                    <label for="booking" class="inline-block cursor-pointer whitespace-nowrap rounded-full border border-black px-2 py-1 text-sm">
                        <input
                            id="booking"
                            type="radio"
                            wire:model.live="select"
                            value="booking"
                            class="sr-only"
                        >
                        booking
                    </label>
                </form>

                <form x-on:submit.prevent="message.trim() !== '' ? $wire.sendMessage() : null"
                    class="flex h-[40px] items-center border-t border-gray-200">
                    <input
                        type="text"
                        placeholder="Enter message..."
                        class="block h-full w-full px-4 focus:outline-none"
                        wire:model="message"
                        x-model="message"
                    >

                    <button class="px-2">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    @endpersist
</div>
