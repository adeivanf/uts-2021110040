<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil transaksi dengan paginasi setiap 10 data
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(10);
    
        // Menghitung saldo total (total income - total expense)
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
    
        // Menghitung jumlah transaksi income dan expense
        $numIncomeTransactions = $transactions->where('type', 'income')->count();
        $numExpenseTransactions = $transactions->where('type', 'expense')->count();
    
        return view('transactions.index', [
            'transactions' => $transactions,
            'balance' => $balance,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'numIncomeTransactions' => $numIncomeTransactions,
            'numExpenseTransactions' => $numExpenseTransactions,
        ]);
    }    
    /**
     * Show the form for creating a new transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created transaction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        Transaction::create($data);
        
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    /**
     * Display the specified transaction.
     *
     * @param  Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     *
     * @param  Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified transaction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $transaction->update($data);
        
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param  Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
