<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expenses List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Expenses List') }}
                <a href="{{ route('expense.create') }}" class="btn btn-primary float-end">Add Expense</a>
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container mt-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Manage your Expenses here.</h4>
                            </div>
                            <div class="card-body">
                                <!-- Success Message -->
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                <!-- Expenses Table -->
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($expenses as $expense)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $expense->ExpenseCategory }}</td>
                                                <td>${{ number_format($expense->Amount, 2) }}</td>
                                                <td>{{ $expense->Description ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($expense->Date)->format('d-m-Y') }}</td>
                                                <td>
                                                    <a href="{{ route('expense.edit', $expense->ExpensesID) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="{{ route('expense.destroy', $expense->ExpensesID) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this expense?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No Expenses Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
