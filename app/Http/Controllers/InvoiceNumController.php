<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Num;
use Illuminate\Http\Request;
use App\Models\Contract;

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
        $contracts = Contract::all();

        // Generate new unique invoice number
        // $invoices = Invoice_Num::latest()->first();
        // $nextNumber = $invoices ? ((int)substr($invoices->InvoiceNumber, -3)) + 1 : 1;
        // $newInvoiceNumber = 'INV-' . now()->format('Ymd') . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);


        return view("invoice.create", compact('contracts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        // Validate the request data
        $request->validate([
            'InvoiceNumber' => 'required|string|unique:invoices,InvoiceNumber',
            'InvoiceType' => 'required|in:internal,external',
            'InvoiceSource' => 'required|in:Purchase,Sale,Transaction',
            'Date' => 'required|date',
            'PaymentMethod' => 'nullable|string|required_if:InvoiceType,external',
            'Amount' => 'nullable|numeric',
            'Quantity' => 'nullable|numeric',
            'TotalAmount' => 'nullable|numeric',
            'Description' => 'nullable|string',
            'ContractID' => 'nullable|integer|exists:contracts,ContractID|required_if:InvoiceSource,Purchase',
            'SaleID' => 'nullable|integer|exists:sales,SaleID|required_if:InvoiceSource,Sale',
            'TransactionID' => 'nullable|integer|exists:transactions,TransactionID|required_if:InvoiceSource,Transaction',
        ]);

        // Create invoice
        $invoice = Invoice_Num::create([
            'InvoiceNumber' => $request->InvoiceNumber,
            'InvoiceType' => $request->InvoiceType,
            'InvoiceSource' => $request->InvoiceSource,
            'Date' => $request->Date,
            'PaymentMethod' => $request->InvoiceType === 'external' ? $request->PaymentMethod : null,
            'Amount' => $request->Amount,
            'Quantity' => $request->Quantity,
            'TotalAmount' => $request->TotalAmount,
            'Description' => $request->Description,
            'ContractID' => $request->InvoiceSource === 'Purchase' ? $request->ContractID : null,
            'SaleID' => $request->InvoiceSource === 'Sale' ? $request->SaleID : null,
            'TransactionID' => $request->InvoiceSource === 'Transaction' ? $request->TransactionID : null,
        ]);

        return redirect()->route('invoice.index')->with('status', 'Invoice created successfully.');
    }

        // $request->validate([
        //     'Source' => 'required|in:purchase,sale,transaction,manual',
        //     'Amount' => 'required|numeric|min:0',
        //     'Description' => 'nullable|string',
        //     'InvoiceType' => 'required|in:internal,external',
        //     'SaleID' => 'nullable|exists:sales,id',
        //     'PurchaseID' => 'nullable|exists:purchases,id',
        //     'TransactionID' => 'nullable|exists:transactions,id',
        // ]);
    
        // // Generate Invoice Number for Internal Invoices
        // $invoiceNumber = ($request->InvoiceType === 'internal') 
        //     ? 'INV-' . time() 
        //     : $request->InvoiceNumber;
    
        // Invoice_Num::create([
        //     'InvoiceNumber' => $invoiceNumber,
        //     'InvoiceType' => $request->InvoiceType,
        //     'Source' => $request->Source,
        //     'Amount' => $request->Amount,
        //     'Description' => $request->Description,
        //     'SaleID' => $request->SaleID,
        //     'PurchaseID' => $request->PurchaseID,
        //     'TransactionID' => $request->TransactionID,
        // ]);
    
        // return redirect()->route('invoice.index')->with('success', 'Invoice created successfully.');
    
    

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
    public function destroy(Invoice_Num $invoice)
    {
        // Delete the invoice
        $invoice->delete();

        return redirect()->route('invoice.index')->with('success', 'Invoice deleted successfully.');
    }
}
