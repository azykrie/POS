<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\User;
use Livewire\Component;

class View extends Component
{
    public function render()
    {
        return view('livewire.dashboard.view',[
            'users' => User::count(),
            'totals' => TransactionDetail::sum('total'),
            'orders' => Order::count(),
            'produts' => Product::count()
        ]);
    }
}
