<?php

namespace App\Livewire\Admin;

use App\Enums\TransactionStatus;
use App\Models\Transaction;
use Livewire\Component;

class TransactionsPendingTotal extends Component
{
    public function render()
    {
        return view('livewire.admin.transactions-pending-total', [
            'total' => Transaction::where('status', TransactionStatus::Pending)->sum('amount'),
        ]);
    }
}
