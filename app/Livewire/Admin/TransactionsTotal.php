<?php

namespace App\Livewire\Admin;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Livewire\Component;

class TransactionsTotal extends Component
{
    public string $range = 'all';

    public function render()
    {
        return view('livewire.admin.transactions-total', [
            'total' => Transaction::where('status', TransactionStatus::Approved)
            ->when($this->range === 'current', function ($query) {
                $query->whereYear('created_at', today());
            })
            ->when($this->range === 'previous', function ($query) {
                $query->whereYear('created_at', today()->subYear());
            })
            ->sum('amount'),
        ]);
    }
}
