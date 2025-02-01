<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Num;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        // $sales = Sale::with('invoice', 'product')->paginate(10);
        // return view("sale.index", [
        //     'sales' => $sales // Pass sales to the view
        // ]);
        // Start with a query builder for the Sale model
        $query = Sale::query();

        // Filter by Invoice Number
        if ($request->filled('InvoiceNumber')) {
            $query->where('InvoiceNumber', 'like', '%' . $request->InvoiceNumber . '%');
        }

        // Filter by Customer Name
        if ($request->filled('CustomerName')) {
            $query->where('CustomerName', 'like', '%' . $request->CustomerName . '%');
        }

        // Filter by Product Name (through relationships)
        if ($request->filled('ProductName')) {
            $query->whereHas('inventory.invoice.contract.product', function ($q) use ($request) {
                $q->where('ProductName', 'like', '%' . $request->ProductName . '%');
            });
        }

        // Filter by Sale Date
        if ($request->filled('SaleDate')) {
            $query->whereDate('SaleDate', $request->SaleDate);
        }

        // Filter by Total Price
        if ($request->filled('Total')) {
            $query->where('Total', $request->Total);
        }

        // Fetch sales with pagination
        $sales = $query->paginate(10);

        return view('sale.index', compact('sales'));
        
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all inventories with related invoice → contract → product
        $inventories = Inventory::with(['invoice.contract.product'])->get();

        // Generate a unique InvoiceNumber
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        return view('sale.create', compact('inventories', 'invoiceNumber'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'InvoiceID' => 'required|exists:invoices,InvoiceID',
            'CustomerName' => 'required|string|max:255',
            'PricePerUnit' => 'required|string',
            'Quantity' => 'required|integer|min:1',
            'Total' => 'required|numeric',
            'PurchasedUnit' => 'required|string',
            'SaleDate' => 'required|date',
            'Description' => 'nullable|string',
        ]);

        // Get the selected inventory item
        $inventory = Inventory::with('invoice')->findOrFail($request->InventoryID);

        // Ensure there is enough stock
        // if ($request->Quantity > $inventory->invoice->Quantity) {
        //     return back()->withErrors(['Quantity' => 'Not enough stock available.']);
        // }
        if (!$inventory->invoice || $request->Quantity > $inventory->invoice->Quantity) {
            return back()->withErrors(['Quantity' => 'Not enough stock available.']);
        }

        // Generate a unique InvoiceNumber if not provided
        $invoiceNumber = $request->InvoiceNumber ?? ('INV-' . date('Ymd') . '-' . strtoupper(Str::random(6)));

        // Create the Sale
        $sale = Sale::create([
            'InvoiceNumber' => $invoiceNumber,
            'CustomerName' => $request->CustomerName,
            'InvoiceID' => $inventory->invoice->InvoiceID,
            'SaleDate' => $request->SaleDate,
            'Description' => $request->Description,
            'PurchasedUnit' => $request->PurchasedUnit,
            'Quantity' => $request->Quantity,
            'PricePerUnit' => $request->PricePerUnit,
            'Total' => $request->Total,
        ]);

        // Deduct sold quantity from inventory
        $inventory->invoice->Quantity -= $request->Quantity;
        $inventory->invoice->save();

        // Redirect with success message
        return redirect()->route('sale.index')->with('success', 'Sale created successfully.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show($SaleID)
    {
        $sale = Sale::with('inventory.invoice.contract.product')->findOrFail($SaleID);
        return view('sale.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($SaleID)
    {
        $sale = Sale::findOrFail($SaleID);
        $inventories = Inventory::with(['invoice.contract.product.category'])->get(); // Fetch inventories with related data
    
        return view("sale.edit", compact("sale", "inventories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $SaleID)
    {
        $request->validate([
            'InvoiceNumber' => 'required|string|max:255',
            'CustomerName' => 'required|string|max:255',
            'PricePerUnit' => 'required|numeric|min:0',
            'Quantity' => 'required|integer|min:1',
            'Total' => 'required|numeric|min:0',
            'PurchasedUnit' => 'required|string',
            'SaleDate' => 'required|date',
            'Description' => 'nullable|string',
        ]);

        $sale = Sale::findOrFail($SaleID);
        $sale->update([
            'InvoiceNumber' => $request->InvoiceNumber,
            'CustomerName' => $request->CustomerName,
            'PricePerUnit' => $request->PricePerUnit,
            'Quantity' => $request->Quantity,
            'Total' => $request->Total,
            'PurchasedUnit' => $request->PurchasedUnit,
            'SaleDate' => $request->SaleDate,
            'Description' => $request->Description,
        ]);

        return redirect()->route('sale.index')->with('success', 'Sale updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        // Find the related invoice and delete it
        $invoice = Invoice_Num::where('SaleID', $sale->SaleID)->first();
        if ($invoice) {
            $invoice->delete(); // Delete the invoice first
        }

        // Now delete the sale
        $sale->delete();

        return redirect()->route('sale.index')->with('success', 'Sale and its related invoice deleted successfully.');
    }
}
