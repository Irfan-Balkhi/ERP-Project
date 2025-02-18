<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Transaction List') }}
            </h2>
            @include('transaction.nav-links')
            <a href="{{ route('transaction.create') }}" class="btn btn-primary float-end">Add Transaction</a>    
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('transaction.index') }}" method="GET" class="form-inline justify-center d-flex">
                                <input type="text" name="TransactionID" value="{{ request('TransactionID') }}" class="form-control ml-2 mr-2"
                                    placeholder="Search by Transaction ID" style="background-color: rgb(240, 240, 240)">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2"
                                    placeholder="Search by Customer Name" style="background-color: rgb(240, 240, 240)">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('transaction.index') }}" class="btn btn-secondary ml-2">Clear</a>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            {{-- Pagination can be added here --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction ID</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Source</th>
                                        <th>Date</th>
                                        <th>Supplier</th>
                                        <th>Account</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $key + 1 }}</td>
                                        <td>{{ $transaction->TransactionID }}</td>
                                        <td>{{ $transaction->CustomerName }}</td>
                                        <td>${{ number_format($transaction->amount, 2) }}</td>
                                        <td>{{ ucfirst($transaction->transaction_type) }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $transaction->source)) }}</td>
                                        <td>{{ $transaction->transaction_date }}</td>
                                        <td>{{ $transaction->supplier->name ?? 'N/A' }}</td>
                                        <td>{{ $transaction->account->name ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('transaction.edit', $transaction->TransactionID) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('transaction.destroy', $transaction->TransactionID) }}" method="POST" id="delete-form-{{ $transaction->TransactionID }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                            
                                                <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $transaction->TransactionID }}')" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        if (confirm("Are you sure you want to delete this transaction?")) {
            document.getElementById(formId).submit();
        }
    }
</script>
</body>
</html>
