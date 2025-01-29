<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Product;
use App\Models\Invoice_Num;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //with(['product', 'purchase'])->
        // Fetch all inventories with related product and purchase data
        $inventories = Inventory::get();

        // Pass the data to the inventory index view
        return view('inventory.index', compact('inventories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contracts = Contract::with('supplier')->get(); // Fetch contracts with suppliers
        return view('inventory.create', compact('contracts'));
    }
    public function getInvoicesByContract($contractID)
    {
        $invoices = Invoice_Num::where('ContractID', $contractID)->select('InvoiceID', 'InvoiceNumber')->get();
        return response()->json($invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'InvoiceID'     => 'required|exists:invoices,InvoiceID',
            'ExtraExpense'  => 'required|numeric|min:0',
            'Description'   => 'nullable|string|max:255',
        ]);

        // Create inventory record
        Inventory::create([
            'InvoiceID'    => $request->InvoiceID,
            'ExtraExpense' => $request->ExtraExpense,
            'Description'  => $request->Description,
        ]);

        // Redirect with success message
        return redirect()->route('inventory.index')->with('success', 'Inventory record added successfully.');
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
    public function edit($InventoryID)
    {
        $inventory = Inventory::findOrFail($InventoryID);
        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $InventoryID)
    {
        $request->validate([
            'ExtraExpense' => 'required|numeric|min:0',
            'Description' => 'nullable|string|max:255',
        ]);

        $inventory = Inventory::findOrFail($InventoryID);
        $inventory->ExtraExpense = $request->ExtraExpense;
        $inventory->Description = $request->Description;
        $inventory->save();

        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully!');
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
