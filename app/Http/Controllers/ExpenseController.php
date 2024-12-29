<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all(); // Fetch all expenses
        return view('expense.index', compact('expenses')); // Return a view with expenses
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense.create'); // for create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'ExpenseCategory' => 'required|string|max:255',
            'Amount' => 'required|numeric|min:0',
            'Description' => 'nullable|string',
            'Date' => 'required|date',
        ]);

        // Create the expense
        Expense::create($request->all());

        return redirect()->route('expense.index')->with('success', 'Expense added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expenses)
    {
        //
    }
}
