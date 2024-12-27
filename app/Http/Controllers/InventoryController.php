<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all inventories with related product and purchase data
        $inventories = Inventory::with(['product', 'purchase'])->get();

        // Pass the data to the inventory index view
        return view('inventory.index', compact('inventories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchases = Purchase::all();
        $products = Product::all();
        return view('inventory.create', compact('purchases', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'PurchaseID' => 'required|exists:purchases,PurchaseID',
            'ProductID' => 'required|exists:products,ProductID',
            'Quantity' => 'required|integer|min:1',
            'TotalPurchasedPrice' => 'required|numeric|min:0',
        ]);

        Inventory::create([
            'PurchaseID' => $validated['PurchaseID'],
            'ProductID' => $validated['ProductID'],
            'ProductName' => Product::find($validated['ProductID'])->ProductName,
            'Quantity' => $validated['Quantity'],
            'TotalPurchasedPrice' => $validated['TotalPurchasedPrice'],
        ]);

        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($inventoryID)
    {
        // Find the inventory item by its ID
        $inventory = Inventory::findOrFail($inventoryID);

        // Delete the inventory item
        $inventory->delete();

        // Redirect back with a success message
        return redirect()->route('inventory.index')->with('success', 'Inventory item deleted successfully.');
    }
}
