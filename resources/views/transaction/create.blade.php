<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add Transaction') }}
                <a href="{{ route('transaction.index') }}" class="btn btn-secondary float-end">Cancel</a>

            </h2>
        </x-slot>
    
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container mt-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transaction.store') }}" method="POST">
                            @csrf
    
                            <div class="mb-3">
                                <label class="form-label">Transaction ID</label>
                                <input type="text" name="TransactionID" class="form-control" required>
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Customer Name</label>
                                <input type="text" name="CustomerName" class="form-control" required>
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Amount</label>
                                <input type="number" name="amount" class="form-control" step="0.01" required>
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Transaction Type</label>
                                <select name="transaction_type" class="form-control" required>
                                    <option value="income">Income</option>
                                    <option value="expense">Expense</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Source</label>
                                {{-- <input type="text" name="source" class="form-control" required> --}}
                                <select name="source" class="form-control" required>
                                    <option value="payment_to_supplier">payment_to_supplier</option>
                                    <option value="salary_payment">salary_payment</option>
                                    <option value="daily_expense">daily_expense</option>
                                    <option value="payment_to_distributors">payment_to_distributors</option>
                                    <option value="customer_payment_received">customer_payment_received</option>
                                    <option value="transfer_to_sarrafi">transfer_to_sarrafi</option>
                                    <option value="transfer_to_cash">transfer_to_cash</option>
                                    <option value="miscellaneous_income">miscellaneous_income</option>
                                    <option value="other_expense">other_expense</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Transaction Date</label>
                                <input type="date" name="transaction_date" class="form-control" required>
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Supplier</label>
                                <select name="SupplierID" class="form-control">
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->SupplierID }}">{{ $supplier->CompanyName }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label class="form-label">Account</label>
                                <select name="accountID" class="form-control">
                                    <option value="">Select Account</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->accountID }}">{{ $account->name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <button type="submit" class="btn btn-primary">Save Transaction</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
