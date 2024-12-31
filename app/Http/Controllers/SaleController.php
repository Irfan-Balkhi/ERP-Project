<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $sales = Sale::with('invoice', 'product')->paginate(10);
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
        // Validate the request data
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
    
        // Find the product and its inventory
        $product = Product::find($request->ProductID);
    
        if (!$product || !$product->inventory) {
            return redirect()->back()->withErrors(['ProductID' => 'Product or inventory record not found.']);
        }
    
        // Check if there is enough stock available
        if ($product->inventory->Quantity < $request->Quantity) {
            return redirect()->back()->withErrors(['Quantity' => 'Not enough stock available.']);
        }
    
        // Save the sale only if the quantity is valid
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
    
        // Deduct the quantity from inventory after saving the sale
        $product->inventory->Quantity -= $request->Quantity;
        $product->inventory->save();
    
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
