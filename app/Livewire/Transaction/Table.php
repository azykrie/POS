<?php

namespace App\Livewire\Transaction;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Barryvdh\DomPDF\Facade\Pdf;

class Table extends Component
{
    public $product_id;
    public $quantity;
    public $total;
    public $pay;

    public function submit()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id|unique:transactions,product_id',
        ]);

        $transaction = Transaction::create([
            'product_id' => $this->product_id,
            'quantity' => 1,
            'total' => 0,
        ]);

        $transaction->total = $transaction->product->price;
        $transaction->Save();
        $this->reset('product_id');
        session()->flash('message', 'Product added successfully');
    }

    public function increment($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'quantity' => $transaction->quantity + 1,
            'total' => $transaction->product->price * ($transaction->quantity + 1)
        ]);
        session()->flash('message', 'Product added successfully');
    }

    public function decrement($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'quantity' => $transaction->quantity - 1,
            'total' => $transaction->product->price * ($transaction->quantity - 1)
        ]);
        session()->flash('message', 'Product has been successfully reduced');
    }

    public function delete($id)
    {
        Transaction::find($id)->delete();
        session()->flash('message', 'Product has been successfully deleted');
    }

    public function save()
    {
        $order = Order::create([
            'order_no' =>  'OD-' . date('Ymd') . rand(1111, 9999),
            'cashier_name' => auth()->user()->name,
        ]);

        $transaction = Transaction::get();

        foreach ($transaction as $value) {
            $product = [
                'order_id' => $order->id,
                'product_id' => $value->product_id,
                'quantity' => $value->quantity,
                'total' => $value->total,
                'created_at' => \Carbon\carbon::now(),
                'updated_at' => \Carbon\carbon::now()
            ];

            $transactionDetail = TransactionDetail::insert($product);
            $deleteTransaction = Transaction::where('id', $value->id)->delete();
        }

        return redirect('transaction');
    }

    public function print()
    {
        $data = Transaction::all()->toArray();
        $pdf = Pdf::loadView('livewire.transaction.invoice', $data);
        return $pdf->download('example.pdf');
    }

    public function render()
    {
        return view('livewire.transaction.table', [
            'products' => Product::all(),
            'transactions' => Transaction::all()
        ]);
    }
}
