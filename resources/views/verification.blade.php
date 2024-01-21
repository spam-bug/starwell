<x-guest-layout>
    <div class="mx-auto w-full max-w-7xl p-4 sm:p-6 lg:p-8">
        <h1 class="text-center text-2xl font-bold">Verify Email</h1>
        <form
            action="{{ route('verification.send') }}"
            method="POST"
            class="mx-auto mt-8 max-w-lg rounded border border-gray-200 bg-white p-4"
        >
            @csrf
            <p>
                To use this application please verify your email address first.
            </p>

            <div class="mt-4 flex justify-end">
                <x-button variety="primary">Resend</x-button>
            </div>
        </form>
    </div>
</x-guest-layout>
