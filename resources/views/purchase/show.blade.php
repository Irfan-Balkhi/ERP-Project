{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Purchase Details for Invoice #') }} {{ $purchase->InvoiceNumber }}
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Purchase Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Purchase ID</th>
                                    <td>{{ $purchase->PurchaseID }}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Number</th>
                                    <td>{{ $purchase->InvoiceNumber }}</td>
                                </tr>
                                <tr>
                                    <th>Seller Name</th>
                                    <td>{{ $purchase->SellerName }}</td>
                                </tr>
                                <tr>
                                    <th>Category Name</th>
                                    <td>{{ $purchase->category ? $purchase->category->Name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{ $purchase->product ? $purchase->product->ProductName : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Purchase Date</th>
                                    <td>{{ $purchase->PurchaseDate }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $purchase->Description }}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{ $purchase->Quantity }}</td>
                                </tr>
                                <tr>
                                    <th>Price Per Unit</th>
                                    <td>{{ $purchase->PricePerUnit }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>{{ $purchase->Total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('purchase.index') }}" class="btn btn-secondary mt-3">Back to Purchases List</a>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}
