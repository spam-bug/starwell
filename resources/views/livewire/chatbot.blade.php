<div>
    @persist('chatbot')
        <div
            x-data="{ show: false, message: '' }"
            class="fixed bottom-0 right-10 w-64 shadow-2xl"
        >
            <div x-on:click="show = !show" class="cursor-pointer bg-gray-900 px-4 py-2 text-white flex items-center gap-2 rounded-t">
                <i class="fa-solid fa-robot"></i>
                <p>Chat Now</p>
            </div>

            <div x-show="show" x-collapse x-cloak class="min-h-[300px] bg-white">
                <div class="flex flex-col-reverse h-[260px] overflow-y-auto">
                    <div class=" p-4 space-y-4">
                        @foreach($messages as $message)
                            <div class="p-2 rounded w-fit {{ $message['type'] === 'user' ? 'bg-blue-600 text-white ml-auto' : 'bg-gray-100' }}">
                                {!! $message['content'] !!}
                            </div>
                        @endforeach
                        <div class="flex items-center justify-center bg-gray-100 rounded p-4 w-fit" wire:loading.flex wire:target="sendMessage">
                            <div class="bg-gray-500 w-2 h-2 rounded-full animate-bounce mx-1"></div>
                            <div class="bg-gray-500 w-2 h-2 rounded-full animate-bounce mx-1" style="animation-delay: 0.1s;"></div>
                            <div class="bg-gray-500 w-2 h-2 rounded-full animate-bounce mx-1" style="animation-delay: 0.2s;"></div>
                        </div>
                    </div>
                </div>

                <form x-on:submit.prevent="message.trim() !== '' ? $wire.sendMessage() : null" class="flex items-center border-t border-gray-200 h-[40px]">
                    <input
                        type="text"
                        placeholder="Enter message..."
                        class="w-full block h-full focus:outline-none px-4"
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
