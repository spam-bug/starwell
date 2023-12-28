<?php

namespace App\Livewire\Admin;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Livewire\Component;

class TransactionMonthlyTotal extends Component
{
    public function render()
    {
        return view('livewire.admin.transaction-monthly-total', [
            'total' => Transaction::where('status', TransactionStatus::Approved)
                ->whereMonth('created_at', today())
                ->sum('amount')
        ]);
    }
}
