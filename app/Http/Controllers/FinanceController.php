<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Expense;
use App\Models\Transaction;
use Carbon\Carbon;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch summary data for the dashboard
        $totalPurchases = Purchase::sum('Total');
        $totalSales = Sale::sum('Total');
        $totalTransactions = Transaction::sum('Amount');
        $totalExpenses = Expense::sum('Amount');

        // Calculate profit or loss
        // $profitOrLoss = $totalSales - ($totalPurchases + $totalExpenses);

        $totalPurchases = Purchase::sum('Total') ?? 0;
        $totalSales = Sale::sum('Total') ?? 0;
        $totalTransactions = Transaction::sum('Amount');
        $totalExpenses = Expense::sum('Amount') ?? 0;
        $profitOrLoss = $totalSales - ($totalPurchases + $totalExpenses);


        // Pass the data to the view
        return view('finance.index', compact('totalPurchases', 'totalSales', 'totalTransactions', 'totalExpenses', 'profitOrLoss'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Manually update finance data.
     */
    public function updateFinanceData()
    {
        // Fetch total purchases, sales, and expenses
        $totalPurchases = Purchase::sum('Total'); // Adjust field name as necessary
        $totalSales = Sale::sum('amount'); // Adjust field name as necessary
        $additionalExpenses = Expense::sum('Amount');

        // Calculate profit or loss
        $profitOrLoss = $totalSales - ($totalPurchases + $additionalExpenses);

        // Update or create finance record for today
        $finance = Finance::updateOrCreate(
            ['Date' => Carbon::today()],
            [
                'TotalPurchases' => $totalPurchases,
                'TotalSales' => $totalSales,
                'AdditionalExpenses' => $additionalExpenses,
                'ProfitOrLoss' => $profitOrLoss,
            ]
        );

        return response()->json(['message' => 'Finance data updated successfully!', 'data' => $finance]);
    }

    // public function showPurchases()
    // {
    //     $purchases = Purchase::all(); // Fetch purchase details
    //     return view('finance.purchases', compact('purchases'));
    // }

    public function showPurchases(Request $request)
{
    // Initialize a query
    $query = Purchase::query();

    // Filter by day
    if ($request->has('day')) {
        $query->whereDate('created_at', $request->day);
    }

    // Filter by month
    if ($request->has('month')) {
        $query->whereMonth('created_at', $request->month);
    }

    // Filter by year
    if ($request->has('year')) {
        $query->whereYear('created_at', $request->year);
    }

    // Fetch filtered purchases
    $purchases = $query->get();

    // Calculate the total amount
    $totalAmount = $purchases->sum('amount');

    // Pass the data to the view
    return view('finance.purchase', compact('purchases', 'totalAmount'));
}

    public function showSales()
    {
        $sales = Sale::all(); // Fetch sales details
        return view('finance.sales', compact('sales'));
    }

    // public function showTransactions()
    // {
    //     $transactions = Transaction::all(); // Fetch transaction details
    //     return view('finance.transactions', compact('transactions'));
    // }

    public function showExpenses()
    {
        $expenses = Expense::all(); // Fetch expense details
        return view('finance.expenses', compact('expenses'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Finance $finance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Finance $finance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Finance $finance)
    {
        //
    }
}
