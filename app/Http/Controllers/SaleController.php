<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Inventory;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $sales = Sale::with('invoice')->paginate(10);
        return view("sale.index", [
            'sales' => $sales // Pass sales to the view
        ]);
        
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Inventory::all(); // Fetch all available products from inventory
        return view('sale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    $validated = $request->validate([
        'InvoiceNumber' => 'required|unique:sales',
        'CustomerName' => 'required|string|max:255',
        'ProductID' => 'required|exists:inventories,ProductID',
        'SaleDate' => 'required|date',
        'Description' => 'nullable|max:255',
        'PurchasedUnit' => 'required|string|max:255',
        'Quantity' => 'required|integer|min:1',
        'PricePerUnit' => 'required|numeric|min:0',
        'Total' => 'required|numeric|min:0',
    ]);

    // Save to the database
    $sale = Sale::create([
        'InvoiceNumber' => $request->InvoiceNumber,
        'CustomerName' => $request->CustomerName,
        'ProductID' => $request->ProductID,
        'SaleDate' => $request->SaleDate,
        'Description' => $request->Description,
        'PurchasedUnit' => $request->PurchasedUnit,
        'Quantity' => $request->Quantity,
        'PricePerUnit' => $request->PricePerUnit,
        'Total' => $request->Total,
    ]);
        $product = Inventory::find($request->ProductID);
    if ($product->Quantity < $request->Quantity) {
        return redirect()->back()->withErrors(['Quantity' => 'Not enough stock available.']);
    }
    $product->Quantity -= $request->Quantity;
    $product->save();

    return redirect()->route('sale.index')->with('success', 'Sale created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view("sale.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        return view("sale.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        return view('sale.destroy');
    }
}
