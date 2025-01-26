<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Purchase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Purchase') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="card">
                <div class="card-header">
                    <h4>Purchase Details</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Contract</th>
                                <td>{{ $purchase->contract->ContractID ?? 'No Contract' }}</td>
                            </tr>
                            <tr>
                                <th>Supplier</th>
                                <td>{{ $purchase->supplier->CompanyName ?? 'No Supplier' }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $purchase->category->Name ?? 'No Category' }}</td>
                            </tr>
                            <tr>
                                <th>Product</th>
                                <td>{{ $purchase->product->ProductName ?? 'No Product' }}</td>
                            </tr>
                            <tr>
                                <th>Purchase Date</th>
                                <td>{{ $purchase->PurchaseDate }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $purchase->Description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('purchase.index') }}" class="btn btn-secondary">Back to Purchases</a>
            </div>
        </div>
    </div>
</x-app-layout>
</body>
</html>
