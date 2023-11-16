<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class InvoiceController extends Controller
{
    public function pdf()
    {
        $totals = Transaction::sum('total');
        $transactions = Transaction::all();
        $pdf = FacadePdf::loadView('transaction.invoice', compact('transactions' , 'totals'));
        return $pdf->download('invoice.pdf');
    }
}

