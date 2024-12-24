<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', [
            'products'=> $products //pass for perview
        ]);  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories for the dropdown

        return view('product.create', compact('categories'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // Validate incoming request data
        $validated = $request->validate([
            'ProductName' => 'required|string|max:255',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Description' => 'nullable|string',
        ]);

        // save to the database
        $product = Product::create([
            'ProductName' => $request->ProductName,
            'CategoryID' => $request->CategoryID,
            'Description' => $request->Description,
        ]);
    


        return redirect()->route('product.index')->with('success', 'product created successfully!');
    }

    //     public function getProductsByCategory($CategoryID)
    // {
    //     $products = Product::where('CategoryID', $CategoryID)->get(['ProductID', 'ProductName']);
    //     return response()->json($products);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show');  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit');  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
