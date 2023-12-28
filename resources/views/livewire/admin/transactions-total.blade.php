<div class="bg-white rounded border border-gray-200 p-4">
    <p class="text-sm font-semibold text-gray-600">Transactions Total</p>
    <h1 class="mt-2 text-2xl font-bold">₱ {{ number_format(substr($total, 0, -2) . '.' . substr($total, -2), 2) }}</h1>
</div>
