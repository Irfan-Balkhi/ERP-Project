<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Models\Category;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::with('invoice')->paginate(10);
        return view("purchase.index", [
            'purchases' => $purchases // Pass purchases to the view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories for the dropdown

        return view('purchase.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        

        $validated = $request->validate([
            'InvoiceNumber' => 'required|unique:purchases',
            'SellerName' => 'required|string|max:255',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'PurchaseDate' => 'required|date',
            'Description' => 'nullable|max:255',
            'Quantity' => 'required|integer|min:1',
            'PricePerUnit' => 'required|numeric|min:0',
            'Total' => 'required|numeric|min:0',
        ]);

            // Calculate the total
            // $total = $request->Quantity * $request->PricePerUnit;

        // Save to the database
        $purchase = Purchase::create([
            'InvoiceNumber' => $request->InvoiceNumber,
            'SellerName' => $request->SellerName,
            'CategoryID' => $request->CategoryID,
            'PurchaseDate' => $request->PurchaseDate,
            'Description' => $request->Description,
            'Quantity' => $request->Quantity,
            'PricePerUnit' => $request->PricePerUnit,
            'Total' => $request->Total,
        ]);

        return redirect()->route('purchase.index')->with('success', 'Purchase created successfully!');
    
    }



    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        return view("purchase.show");

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        return view("purchase.edit");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}







//     public function store(Request $request)
// {
//     // Debug: Check if the store method is being called
//     \Log::info('Store method called.');

//     // Debug: Dump all request data
//     \Log::info('Request data:', $request->all());

//     try {
//         // Validate the request
//         \Log::info('Starting validation...');
//         $validated = $request->validate([
//             'InvoiceNumber' => 'required|unique:purchases',
//             'SellerName' => 'required|string|max:255',
//             // 'CategoryID' => 'required|exists:categories,id',
//             'CategoryID' => 'required|exists:categories,CategoryID',
//             'PurchaseDate' => 'required|date',
//             'Description' => 'nullable|max:255',
//             'Quantity' => 'required|integer|min:1',
//             'PricePerUnit' => 'required|numeric|min:0',
//             'Total' => 'required|numeric|min:0',
//         ]);
//         \Log::info('Validation passed.');

//         // Debug: Show validated data
//         \Log::info('Validated data:', $validated);

//         // Save to the database
//         \Log::info('Saving to the database...');
//         $purchase = Purchase::create([
//             'InvoiceNumber' => $request->InvoiceNumber,
//             'SellerName' => $request->SellerName,
//             'CategoryID' => $request->CategoryID,
//             'PurchaseDate' => $request->PurchaseDate,
//             'Description' => $request->Description,
//             'Quantity' => $request->Quantity,
//             'PricePerUnit' => $request->PricePerUnit,
//             'Total' => $request->Total,
//         ]);
//         \Log::info('Purchase saved:', $purchase->toArray());

//         return redirect()->route('purchase.index')->with('success', 'Purchase created successfully!');
//     } catch (\Exception $e) {
//         // Debug: Log the exception
//         \Log::error('Error occurred while saving purchase: ' . $e->getMessage(), [
//             'trace' => $e->getTraceAsString(),
//         ]);

//         // Optionally display a user-friendly error
//         return back()->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
//     }
// }