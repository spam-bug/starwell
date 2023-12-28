<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;

class TransactionsDataTable extends Component
{
    public function render()
    {
        return view('livewire.admin.transactions-data-table', [
            'transactions' => Transaction::paginate(10)
        ]);
    }
}
