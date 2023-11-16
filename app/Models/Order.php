<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'cashier_name',
    ];

    public function transactionDetail()
    {
        return $this->hasMany(TransactionDetail::class, 'order_id');
    }
}
