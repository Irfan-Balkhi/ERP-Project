<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\Supplier;


class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch contracts with their associated supplier
        $contracts = Contract::with('supplier')->paginate(10); // Using eager loading for optimization

        // Return the view with contracts
        return view('contract.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all(); // Fetch all suppliers
        return view('contract.create', compact('suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'SupplierID' => 'required|integer|exists:suppliers,SupplierID',
            'TotalValue' => 'required|numeric',
            'TotalQuantity' => 'required|integer',
            'ContractAttachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after_or_equal:StartDate',
        ]);

        $data = $request->only([
            'SupplierID',
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
    public function show($CategoryID)
    {
        $contract = Contract::findOrFail($CategoryID);
        return view('contract.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
