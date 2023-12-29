<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionsDataTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.transactions-data-table', [
            'transactions' => Transaction::paginate(10)
        ]);
    }
}
