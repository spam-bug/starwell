<div class="rounded border border-gray-200 bg-white p-4">
    <select wire:model.live="range" class="w-full text-sm font-semibold text-gray-600 focus:outline-none">
        <option value="all">Overall Transaction Total</option>
        <option value="current">Current Year Transaction Total</option>
        <option value="previous">Previous Year Transaction Total</option>
    </select>
    <h1 class="mt-2 text-2xl font-bold">₱ {{ number_format(substr($total, 0, -2) . '.' . substr($total, -2), 2) }}</h1>
</div>
