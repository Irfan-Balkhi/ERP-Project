<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Expense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Expense') }}
            <a href="{{ route('expense.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: Fill in the details below to add a new expense.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('expense.store') }}" method="POST">
                                @csrf
    
                                <div class="mb-3">
                                    <label for="ExpenseCategory" class="form-label">Expense Category</label>
                                    <input type="text" class="form-control" id="ExpenseCategory" name="ExpenseCategory" placeholder="Enter Expense Category" required>
                                </div>
    
                                <div class="mb-3">
                                    <label for="Amount" class="form-label">Amount</label>
                                    <input type="number" step="0.01" class="form-control" id="Amount" name="Amount" placeholder="Enter Amount" required>
                                </div>
    
                                <div class="mb-3">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea class="form-control" id="Description" name="Description" rows="3" placeholder="Enter Description (Optional)"></textarea>
                                </div>
    
                                <div class="mb-3">
                                    <label for="Date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="Date" name="Date" required>
                                </div>
    
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Add Expense</button>
                                </div>
                            </form>
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
