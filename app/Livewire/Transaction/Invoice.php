<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class Invoice extends Component
{
    public function render()
    {
        return view('livewire.transaction.invoice',[
            'transactions' => Transaction::all()
        ]);
    }
}
