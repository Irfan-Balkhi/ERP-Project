<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Supplier;
use App\Models\Account;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions.
     */
    public function index()
    {
        $transactions = Transaction::with(['supplier', 'account'])->latest()->paginate(10); // Fix: Use paginate()
        return view('transaction.index', compact('transactions'));
    }


    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $accounts = Account::all();
        return view('transaction.create', compact('suppliers', 'accounts'));
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'TransactionID' => 'required|string|unique:transactions,TransactionID',
            'CustomerName' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:income,expense,transfer',
            'source' => 'required|in:payment_to_supplier,salary_payment,daily_expense,payment_to_distributors,customer_payment_received,transfer_to_sarrafi,transfer_to_cash,miscellaneous_income,other_expense',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
            'SupplierID' => 'nullable|exists:suppliers,SupplierID',
            'accountID' => 'required|exists:accounts,accountID',
        ]);

        Transaction::create([
            'TransactionID' => $request->TransactionID, // Added
            'CustomerName' => $request->CustomerName,
            'amount' => $request->amount,
            'transaction_type' => $request->transaction_type,
            'source' => $request->source,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
            'SupplierID' => $request->SupplierID,
            'accountID' => $request->accountID,
        ]);
        

        return redirect()->route('transaction.index')->with('success', 'Transaction added successfully.');
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);
        $suppliers = Supplier::all();
        $accounts = Account::all();
        return view('transaction.edit', compact('transaction', 'suppliers', 'accounts'));
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'CustomerName' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'transaction_type' => 'required|in:income,expense,transfer',
            'source' => 'required|in:payment_to_supplier,salary_payment,daily_expense,payment_to_distributors,customer_payment_received,transfer_to_sarrafi,transfer_to_cash,miscellaneous_income,other_expense',
            'description' => 'nullable|string',
            'transaction_date' => 'required|date',
            'SupplierID' => 'nullable|exists:suppliers,SupplierID',
            'accountID' => 'required|exists:accounts,accountID',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully.');
    }
}
