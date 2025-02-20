<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
// use PDF; // Add this line to import the PDF facade
use Barryvdh\DomPDF\Facade\Pdf as PDF; // Correctly import the PDF facade

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::query();
        $transactionType = $request->input('transaction_type');
        $source = $request->input('source');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

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

    public function download($TransactionID)
    {
        $transactions = Transaction::findOrFail($TransactionID);

        $pdf = PDF::loadView('report.pdf', compact('transactions'));

        return $pdf->download("transaction_report_{$transactions->TransactionID}.pdf");
    }
}