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
        <img src="{{ url('images/logo.svg') }}" alt="Company Logo" width="150">
    </div>

    <h2>Transaction Report</h2>

    <table>
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
                <td>{{ $key + 1 }}</td>
                <td>{{ $transaction->TransactionID }}</td>
                <td>{{ $transaction->CustomerName }}</td>
                <td>${{ number_format($transaction->amount, 2) }}</td>
                <td>{{ ucfirst($transaction->transaction_type) }}</td>
                <td>{{ ucfirst(str_replace('_', ' ', $transaction->source)) }}</td>
                <td>{{ $transaction->transaction_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>