<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Contract;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'contract', 'product', 'category'])->paginate(10);
        return view('purchase.index', compact('purchases'));
    }

    public function create()
    {
        $contracts = Contract::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $categories = Category::all();

        return view('purchase.create', compact('contracts', 'suppliers', 'products', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ContractID' => 'nullable|exists:contracts,ContractID',
            'SupplierID' => 'required|exists:suppliers,SupplierID',
            'ProductID' => 'required|exists:products,ProductID',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'PurchaseDate' => 'required|date',
            'Description' => 'nullable|string',
        ]);

        $purchase = Purchase::create([
            'ContractID' => $request->ContractID,
            'SupplierID' => $request->SupplierID,
            'ProductID' => $request->ProductID,
            'CategoryID' => $request->CategoryID,
            'PurchaseDate' => $request->PurchaseDate,
            'Description' => $request->Description,

        ]);

        return redirect()->route('purchase.index')->with('status', 'Purchase created successfully.');
    }

    public function show($PurchaseID)
    {
        $purchase = Purchase::with(['supplier', 'contract', 'product', 'category'])->findOrFail($PurchaseID);
        return view('purchase.show', compact('purchase'));
    }

    public function edit($PurchaseID)
    {
        $purchase = Purchase::findOrFail($PurchaseID);
        $contracts = Contract::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $categories = Category::all();

        return view('purchase.edit', compact('purchase', 'contracts', 'suppliers', 'products', 'categories'));
    }

    public function update(Request $request, $PurchaseID)
    {
        $request->validate([
            'ContractID' => 'nullable|exists:contracts,ContractID',
            'SupplierID' => 'required|exists:suppliers,SupplierID',
            'ProductID' => 'required|exists:products,ProductID',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'PurchaseDate' => 'required|date',
            'Description' => 'nullable|string',
        ]);

        $purchase = Purchase::findOrFail($PurchaseID);
        $purchase->update($request->all());

        return redirect()->route('purchase.index')->with('status', 'Purchase updated successfully.');
    }

    public function destroy($PurchaseID)
    {
        $purchase = Purchase::findOrFail($PurchaseID);
        $purchase->delete();

        return redirect()->route('purchase.index')->with('status', 'Purchase deleted successfully.');
    }

    public function getSupplierByContract($ContractID)
    {
        $contract = Contract::with('supplier')->findOrFail($ContractID);
        return response()->json($contract->supplier);
    }

    public function getProductsByCategory($CategoryID)
    {
        $products = Product::where('CategoryID', $CategoryID)->get();
        return response()->json($products);
    }
    // public function getContractDetails($ContractID)
    // {
    //     $contract = Contract::where('ContractID', $ContractID)->first();
    
    //     if ($contract) {
    //         return response()->json([
    //             'TotalValue' => $contract->TotalValue ?? 0,
    //             'TotalQuantity' => $contract->TotalQuantity ?? 0,
    //         ]);
    //     }
    
    //     return response()->json(['error' => 'Contract not found'], 404);
    // }

}
