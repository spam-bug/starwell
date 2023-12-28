<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;

class TransactionsCount extends Component
{
    public function render()
    {
        return view('livewire.admin.transactions-count', [
            'count' => Transaction::count(),
        ]);
    }
}
