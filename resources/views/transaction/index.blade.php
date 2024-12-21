<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transactions List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions List') }}
            <a href="{{ route('transaction.create') }}" class="btn btn-primary float-end">Add Transaction</a>
        </h2>
    </x-slot>
    
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Note: Add the complete record of your transactions here</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>InvoiceNumber</th>
                                    <th>TransactionType</th>
                                    <th>Amount</th>
                                    <th>TransactionDate</th>
                                    <th>PaymentMethod</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->InvoiceNumber }}</td>
                                    <td>{{ $transaction->TransactionType }}</td>
                                    <td>{{ $transaction->Amount }}</td>
                                    <td>{{ $transaction->TransactionDate }}</td>
                                    <td>{{ $transaction->PaymentMethod }}</td>
                                    <td>{{ $transaction->Status }}</td>
                                    <td>{{ $transaction->Description }}</td>
                                    <td>
                                        <a href="{{ route('transaction.show', $transaction->InvoiceNumber) }}" class="btn btn-success">Show</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
