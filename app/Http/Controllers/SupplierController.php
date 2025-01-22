<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Start building the query
        $query = Supplier::query();

        // Apply filters based on input
        if ($request->filled('SupplierID')) {
            $query->where('SupplierID', $request->SupplierID);
        }

        if ($request->filled('CompanyName')) {
            $query->where('CompanyName', 'like', '%' . $request->CompanyName . '%');
        }

        if ($request->filled('CompanyContactNumber')) {
            $query->where('CompanyContactNumber', 'like', '%' . $request->CompanyContactNumber . '%');
        }

        // Paginate the filtered results
        $suppliers = $query->paginate(10);

        // Pass suppliers to the view
        return view('supplier.index', compact('suppliers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'CompanyName' => 'required|string|max:255',
            'CompanyEmail' => 'required|email|max:255|unique:suppliers,CompanyEmail',
            'CompanyContactNumber' => 'required|string|max:15',
            'Address' => 'required|string|max:500',
        ]);

        // Create a new supplier record
        $supplier = Supplier::create([
            'CompanyName' => $request->input('CompanyName'),
            'CompanyEmail' => $request->input('CompanyEmail'),
            'CompanyContactNumber' => $request->input('CompanyContactNumber'),
            'Address' => $request->input('Address'),
        ]);

        // Redirect back with a success message
        return redirect()->route('supplier.index')->with('success', 'Supplier added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($SupplierID)
    {
        $supplier = Supplier::findOrFail($SupplierID);
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Supplier $supplier)
    // {
    //     return view('supplier.edit');
    // }
    public function edit($SupplierID)
    {
        $supplier = Supplier::findOrFail($SupplierID);

        return view('supplier.edit', compact('supplier'));
    }


    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, $SupplierID)
    {

        // Validate the request
        $request->validate([
            'CompanyName' => 'required|string|max:255',
            'CompanyEmail' => 'required|email|max:255|unique:suppliers,CompanyEmail,' . $SupplierID . ',SupplierID',
            'CompanyContactNumber' => 'required|string|max:15',
            'Address' => 'required|string|max:500',
        ]);

        // Find the supplier by SupplierID
        $supplier = Supplier::findOrFail($SupplierID);

        // Update the supplier record
        $supplier->update([
            'CompanyName' => $request->input('CompanyName'),
            'CompanyEmail' => $request->input('CompanyEmail'),
            'CompanyContactNumber' => $request->input('CompanyContactNumber'),
            'Address' => $request->input('Address'),
        ]);

        // Redirect back to the index with a success message
        return redirect()->route('supplier.index')->with('status', 'Supplier updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($SupplierID)
    {
         // Find the Supplier by ID
         $supplier = Supplier::findOrFail($SupplierID);

         // Delete the supplier
         $supplier->delete();
 
         // Redirect back with a success message
         return redirect()->route('supplier.index')->with('success', 'Product deleted successfully.');
     
    }
}
