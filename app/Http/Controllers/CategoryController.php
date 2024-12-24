<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view("category.index", [
            "categories"=> $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    
    {
        $request->validate([
            "Name"=> "required|string|max:255",
            "Description"=> "required|string|max:255",
            "Status"=>"required|boolean",

        ]);
        category::create([
            'Name' => $request->Name,
            'Description'=> $request->Description,
            'Status'=> $request->Status,
        ]);

        return redirect('/category')->with('status','Category Created Successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show($CategoryID)
    {
        $category = Category::with('products')->findOrFail($CategoryID);
        return view('category.show', compact('category'));
    }
        

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view("category.edit", compact("category"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            "Name"=> "required|string|max:255",
            "Description"=> "required|string|max:255",
            "Status"=>"required|boolean",
        ]);

        $category->update([
            'Name' => $request->Name,
            'Description'=> $request->Description,
            'Status'=> $request->Status,
        ]);

        return redirect('/category')->with('status','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    public function deactivate($CategoryID)
    {
        // Find the category by ID or fail if it doesn't exist
        $category = Category::findOrFail($CategoryID);

        // Update the is_active status to false (deactivate)
        $category->update(['Status' => false]);

        // Redirect back to the index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category deactivated successfully!');
    }

}
