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
    public function index(Request $request)
    {
        $search = $request->input('search', null);  // Default search to null
        $categoryFilter = $request->input('CategoryID', null);  // Category filter from dropdown
        $trashedFilter = $request->input('filter', null); // Handle trashed filter
        $idFilter = $request->input('ProductID', null); // Get the ProductID filter

        // Start the query for Product model
        $query = Product::query();

        // Apply search filter if provided (search by trade name in English or Farsi)
        if ($search) {
            $query->where('ProductName', 'like', "%{$search}%");
        }

        // Apply category filter if provided
        if ($categoryFilter) {
            $query->where('CategoryID', $categoryFilter);
        }

        // Handle trashed Products if 'filter' is set to 'trashed'
        // if ($trashedFilter === 'trashed') {
        //     $products = $query->onlyTrashed()->paginate(10);
        // } else {
        //     // Show active Products by default
        //     $products = $query->with('category')->paginate(10);

        // }

        // Filter by product ID
        if ($idFilter) {
            $query->where('ProductID', $idFilter); // Assuming 'id' is the primary key column
        }
        $products = $query->with('category')->paginate(10);

        // Fetch all categories for the dropdown filter
        $categories = Category::all();

        // Return the view with filtered items and category dropdown ....
        return view('product.index', compact( 'products', 'categories', 'search', 'categoryFilter'));
    }
    // public function index(Request $request)
    // {
    //     // Determine the order direction (default is descending)
    //     $order = $request->query('order', 'desc'); // 'asc' for ascending, 'desc' for descending

    //     // Order the products based on created_at column
    //     $products = Product::orderBy('created_at', $order)->paginate(7);
    //     $categories = Category::get();
    //     return view('product.index', [
    //         'products' => $products, // Pass the products to the view
    //         'currentOrder' => $order, // Pass the current order to the view for toggling
    //         'categories' => $categories
    //     ]);
    // }


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
        public function show($ProductID)
    {
        $product = Product::findOrFail($ProductID); // Now it uses ProductID
        return view('product.show', compact('product'));
    }
    // 
    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Product $product)
    // {
    //     return view('product.edit');  
    // }
    public function edit($ProductID)
    {
        // Fetch the product by ID
        $product = Product::findOrFail($ProductID);

        // Fetch all categories for the dropdown
        $categories = Category::all();

        // Return the edit view with the product and categories
        return view('product.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Product $product)
    // {
    //     //
    // }
    public function update(Request $request, $ProductID)
{
    // Validate the incoming request data
    $request->validate([
        'ProductName' => 'required|string|max:255',
        'CategoryID' => 'required|exists:categories,CategoryID',
        'Description' => 'nullable|string|max:1000',
    ]);

    // Fetch the product by ID
    $product = Product::findOrFail($ProductID);

    // Update the product with the new data
    $product->update([
        'ProductName' => $request->input('ProductName'),
        'CategoryID' => $request->input('CategoryID'),
        'Description' => $request->input('Description'),
    ]);

    // Redirect back with a success message
    return redirect()->route('product.index')->with('success', 'Product updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($ProductID)
{
    // Find the product by ID
    $product = Product::findOrFail($ProductID);

    // Delete the product
    $product->delete();

    // Redirect back with a success message
    return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
}

}
