<?php

namespace App\Livewire\Admin;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Livewire\Component;

class TransactionsTotal extends Component
{
    public function render()
    {
        return view('livewire.admin.transactions-total', [
            'total' => Transaction::where('status', TransactionStatus::Approved)->sum('amount'),
        ]);
    }
}
