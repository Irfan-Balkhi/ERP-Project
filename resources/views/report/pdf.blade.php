<!DOCTYPE html>
<html>
<head>
    <title>Transaction Report</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .logo { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <!-- Logo Section -->
    <div class="logo">
        <img src="{{ asset('images/logo.svg') }}" alt="Company Logo" width="150">
    </div>

    <h2>Transaction Report</h2>

    <table>
        <tr><th>Transaction ID</th><td>{{ $transactions->TransactionID }}</td></tr>
        <tr><th>Customer Name</th><td>{{ $transactions->CustomerName }}</td></tr>
        <tr><th>Amount</th><td>${{ number_format($transactions->amount, 2) }}</td></tr>
        <tr><th>Type</th><td>{{ ucfirst($transactions->transaction_type) }}</td></tr>
        <tr><th>Source</th><td>{{ ucfirst(str_replace('_', ' ', $transactions->source)) }}</td></tr>
        <tr><th>Date</th><td>{{ $transactions->transaction_date }}</td></tr>
        <tr><th>Supplier</th><td>{{ $transactions->supplier->CompanyName ?? 'N/A' }}</td></tr>
        <tr><th>Account</th><td>{{ $transactions->account->name ?? 'N/A' }}</td></tr>
    </table>

    @if($transactions->invoice)
    <h3>Invoice Details</h3>
    <table>
        <tr><th>Invoice Number</th><td>{{ $transactions->invoice->InvoiceNumber }}</td></tr>
        <tr><th>Contract ID</th><td>{{ $transactions->invoice->contract->ContractID ?? 'N/A' }}</td></tr>
        <tr><th>Product</th><td>{{ $transactions->invoice->contract->product->ProductName ?? 'N/A' }}</td></tr>
        <tr><th>Category</th><td>{{ $transactions->invoice->contract->product->category->Name ?? 'N/A' }}</td></tr>
    </table>
    @endif

    <p><strong>Generated on:</strong> {{ now()->format('d-m-Y H:i') }}</p>
</body>
</html>
