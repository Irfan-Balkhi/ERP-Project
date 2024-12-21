<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transactions List') }}
            <a href="{{ route('transaction.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: add the complete record of your transaction here</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('transaction.store')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="">Invoice Number</label>
                                    <input type="text" name="InvoiceNumber" value="{{ 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6)) }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="SupplierName" class="form-label">Supplier Name</label>
                                    <input type="text" class="form-control" id="SupplierName" name="SupplierName" placeholder="Enter supplier name" autocomplete="off">
                                    {{-- <input type="hidden" id="SupplierID" name="SupplierID"> <!-- Stores the selected Supplier ID --> --}}
                                </div>
                                <div class="mb-3">
                                    <label for="TransactionType" class="form-label">Transaction Type</label>
                                    <select class="form-select" id="TransactionType" name="TransactionType" required>
                                        <option value="" disabled selected>Select Transaction Type</option>
                                        <option value="Purchase">Purchase</option>
                                        <option value="Sale">Sale</option>
                                        <option value="Payment">Payment</option>
                                        <option value="Refund">Refund</option>
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Amount</label>
                                    <input type="number" step="0.01" name="Amount" class="form-control" placeholder="Enter Amount" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Transaction Date</label>
                                    <input type="date" name="TransactionDate" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="PaymentMethod" class="form-label">Payment Method</label>
                                    <select class="form-select" id="PaymentMethod" name="PaymentMethod" required>
                                        <option value="" disabled selected>Select Payment Method</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="Status" class="form-label">Status</label>
                                    <select class="form-select" id="Status" name="Status" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <textarea name="Description" class="form-control" placeholder="Enter Description (Optional)"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
