<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::query()
            ->orderByDesc('id')
            ->paginate();
        return view('transactions', compact('transactions'));
    }
}
