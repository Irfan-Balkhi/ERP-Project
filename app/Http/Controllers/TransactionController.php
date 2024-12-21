<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view("transaction.index");
        $transactions = Transaction::with('invoice')->paginate(10);
        return view("transaction.index", [
            'transactions' => $transactions // Pass transactions to the view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("transaction.create");
    }

    
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
    
            // Validate the request
            $validated = $request->validate([
                'InvoiceNumber' => 'required|unique:transactions|max:255',
                'SupplierName' => 'required|string|max:255',
                'TransactionType' => 'required|in:Purchase,Sale,Payment,Refund,Transfer',
                'Amount' => 'required|numeric|min:0',
                'TransactionDate' => 'required|date',
                'PaymentMethod' => 'required|in:Cash,Bank Transfer,Credit,Cheque',
                'Status' => 'required|in:Pending,Completed,Cancelled',
                'Description' => 'nullable|string|max:500',
            ]);

        
            // Create a transaction
            $transaction = Transaction::create([
                'InvoiceNumber' => $request->InvoiceNumber,
                'SupplierName' => $request->SupplierName,
                'TransactionType' => $request->TransactionType,
                'Amount' => $request->Amount,
                'TransactionDate' => $request->TransactionDate,
                'PaymentMethod' => $request->PaymentMethod,
                'Status' => $request->Status,
                'Description' => $request->Description,
            ]);

        
            return redirect()->route('transaction.index')->with('success', 'Transaction created successfully!');
        }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
