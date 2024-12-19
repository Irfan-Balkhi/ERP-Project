<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Num;
use Illuminate\Http\Request;

class InvoiceNumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice_Num::paginate(10);
        return view("invoice.index", [
            "invoices"=> $invoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("invoice.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Source' => 'required|in:purchase,sale,transaction,manual',
            'Amount' => 'required|numeric|min:0',
            'Description' => 'nullable|string',
            'InvoiceType' => 'required|in:internal,external',
            'SaleID' => 'nullable|exists:sales,id',
            'PurchaseID' => 'nullable|exists:purchases,id',
            'TransactionID' => 'nullable|exists:transactions,id',
        ]);
    
        // Generate Invoice Number for Internal Invoices
        $invoiceNumber = ($request->InvoiceType === 'internal') 
            ? 'INV-' . time() 
            : $request->InvoiceNumber;
    
        Invoice_Num::create([
            'InvoiceNumber' => $invoiceNumber,
            'InvoiceType' => $request->InvoiceType,
            'Source' => $request->Source,
            'Amount' => $request->Amount,
            'Description' => $request->Description,
            'SaleID' => $request->SaleID,
            'PurchaseID' => $request->PurchaseID,
            'TransactionID' => $request->TransactionID,
        ]);
    
        return redirect()->route('invoice.index')->with('success', 'Invoice created successfully.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice_Num $invoice_Num)
    {
        return view("invoice.show");

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice_Num $invoice_Num)
    {
        // return view("invoice.edit");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice_Num $invoice_Num)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice_Num $invoice_Num)
    {
        //
    }
}
