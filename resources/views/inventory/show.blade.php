<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Inventory Details for Inventory ID: ') }} {{ $inventory->InventoryID }}
            </h2>
        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container mt-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Inventory Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Inventory ID</th>
                                <td>{{ $inventory->InventoryID }}</td>
                            </tr>
                            <tr>
                                <th>Contract ID</th>
                                <td>{{ $inventory->invoice->contract->ContractID }}</td>
                            </tr>
                            <tr>
                                <th>Invoice Number</th>
                                <td>{{ $inventory->invoice->InvoiceNumber }}</td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td>{{ $inventory->invoice->contract->supplier->CompanyName }}</td>
                            </tr>
                            <tr>
                                <th>Product Name</th>
                                <td>{{ $inventory->invoice->contract->product->ProductName }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $inventory->invoice->contract->product->category->Name }}</td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>${{ number_format($inventory->invoice->Amount, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Extra Expense</th>
                                <td>${{ number_format($inventory->ExtraExpense, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $inventory->updated_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        </table>

                        <a href="{{ route('inventory.index') }}" class="btn btn-secondary mt-3">Back to Inventory List</a>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
