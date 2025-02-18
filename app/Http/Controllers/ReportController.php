<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ReportController extends Controller
{
    /**
     * Show the report page with filter options.
     */
    public function index(Request $request)
    {
        // Retrieve filter values
        $transactionType = $request->input('transaction_type');
        $source = $request->input('source');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query transactions based on filters
        $query = Transaction::query();

        if ($transactionType) {
            $query->where('transaction_type', $transactionType);
        }

        if ($source) {
            $query->where('source', $source);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('transaction_date', [$startDate, $endDate]);
        }

        $transactions = $query->latest()->paginate(10);

        return view('report.index', compact('transactions'));
    }
}
