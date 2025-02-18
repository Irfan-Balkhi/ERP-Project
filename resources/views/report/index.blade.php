<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.27/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Transaction Report') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('report.index') }}" method="GET" class="form-inline justify-center d-flex">
                                <select name="transaction_type" class="form-control ml-2 mr-2">
                                    <option value="">All Types</option>
                                    <option value="income">Income</option>
                                    <option value="expense">Expense</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                                <select name="source" class="form-control ml-2 mr-2">
                                    <option value="">All Sources</option>
                                    <option value="payment_to_supplier">Payment to Supplier</option>
                                    <option value="salary_payment">Salary Payment</option>
                                    <option value="daily_expense">Daily Expense</option>
                                    <option value="customer_payment_received">Customer Payment Received</option>
                                    <option value="miscellaneous_income">Miscellaneous Income</option>
                                </select>
                                <input type="date" name="start_date" class="form-control mr-2">
                                <input type="date" name="end_date" class="form-control mr-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('report.index') }}" class="btn btn-secondary ml-2">Clear</a>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h4>Filtered Transactions</h4>
                                <button onclick="downloadPDF()" class="btn btn-danger">Download PDF</button>
                            </div>
                            <table class="table table-striped table-bordered" id="reportTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction ID</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Source</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $key + 1 }}</td>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->CustomerName }}</td>
                                        <td>${{ number_format($transaction->amount, 2) }}</td>
                                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $transaction->source)) }}</td>
                                        <td>{{ $transaction->transaction_date }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Pagination links --}}
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.text("Transaction Report", 10, 10);

        doc.autoTable({
            startY: 20,
            head: [['Transaction ID', 'Customer Name', 'Amount', 'Type', 'Source', 'Date']],
            body: Array.from(document.querySelectorAll("#reportTable tbody tr")).map(row => {
                return Array.from(row.cells).map(cell => cell.innerText);
            })
        });

        doc.save("transaction_report.pdf");
    }
</script>
</body>
</html>
