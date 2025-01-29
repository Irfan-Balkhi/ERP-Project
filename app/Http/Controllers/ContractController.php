<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Supplier;


class ContractController extends Controller
{
    // public function showContracts()
    // {
    //     $contracts = Contract::get();
    //     return view('contract.list', compact('contracts'));
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch contracts with their associated supplier
        // $contracts = Contract::with('supplier')->paginate(10); // Using eager loading for optimization
        $contracts = Contract::with(['supplier', 'product'])->paginate(10); // Load product with contract

        // Return the view with contracts
        return view('contract.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch categories
        $suppliers = Supplier::all(); // Fetch suppliers
        return view('contract.create', compact('suppliers', 'categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'SupplierID' => 'required|integer|exists:suppliers,SupplierID',
            'CategoryID' => 'required|integer|exists:categories,CategoryID',
            'ProductID' => 'required|integer|exists:products,ProductID',
            'TotalValue' => 'required|numeric',
            'TotalQuantity' => 'required|integer',
            'ContractAttachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate',
        ]);

        $data = $request->only([
            'SupplierID',
            'CategoryID',
            'ProductID',
            'TotalValue',
            'TotalQuantity',
            'StartDate',
            'EndDate',
        ]);

        // Handle file upload
        if ($request->hasFile('ContractAttachment')) {
            $file = $request->file('ContractAttachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('attachments', $filename, 'public');
            $data['ContractAttachment'] = $filename;
        }

        Contract::create($data);

        return redirect()->route('contract.index')->with('status', 'Contract created successfully.');
    }

    /**
     * Display the specified resource.
     */
    
    public function show($ContractID)
    {
        $contract = Contract::with('invoices')->findOrFail($ContractID);
        return view('contract.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ContractID)
    {
        $contract = Contract::findOrFail($ContractID); // Find the contract or throw a 404
        $suppliers = Supplier::all(); // Get all suppliers for the dropdown
        return view('contract.edit', compact('contract', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ContractID)
    {
        $request->validate([
            'SupplierID' => 'required|exists:suppliers,SupplierID',
            'TotalValue' => 'required|numeric',
            'TotalQuantity' => 'required|integer',
            'ContractAttachment' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate',
        ]);

        $contract = Contract::findOrFail($ContractID);

        // Handle file upload if provided
        if ($request->hasFile('ContractAttachment')) {
            $file = $request->file('ContractAttachment');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('attachments', $filename, 'public');

            // Delete the old attachment if exists
            if ($contract->ContractAttachment) {
                \Storage::disk('public')->delete('attachments/' . $contract->ContractAttachment);
            }

            // Update the file field
            $contract->ContractAttachment = $filename;
        }

        // Update other fields dynamically
        $contract->fill($request->only([
            'SupplierID',
            'TotalValue',
            'TotalQuantity',
            'StartDate',
            'EndDate',
        ]));

        // Save the changes
        $contract->save();

        return redirect()->route('contract.index')->with('status', 'Contract updated successfully.');
    }


    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ContractID)
    {
        $contract = Contract::findOrFail($ContractID);

        // Delete the attachment if it exists
        if ($contract->ContractAttachment) {
            \Storage::disk('public')->delete('attachments/' . $contract->ContractAttachment);
        }

        // Delete the contract
        $contract->delete();

        return redirect()->route('contract.index')->with('status', 'Contract deleted successfully.');
    }
}
