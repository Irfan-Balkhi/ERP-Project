<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details for ') }} {{ $product->ProductName }}
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Product ID</th>
                                    <td>{{ $product->ProductID }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $product->ProductName }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $product->category ? $product->category->Name : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $product->Description }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $product->Price }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Related Purchases</h4>
                    </div>
                    <div class="card-body">
                        @if ($product->purchases->isEmpty())
                            <p>No purchases found for this product.</p>
                        @else
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Purchase ID</th>
                                        <th>Invoice Number</th>
                                        <th>Seller Name</th>
                                        <th>Quantity</th>
                                        <th>Price Per Unit</th>
                                        <th>Total</th>
                                        <th>Purchase Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- $product->purchases as $purchase --}}
                                    @foreach ($product->purchases as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase->PurchaseID }}</td>
                                        <td>{{ $purchase->InvoiceNumber }}</td>
                                        <td>{{ $purchase->SellerName }}</td>
                                        <td>{{ $purchase->Quantity }}</td>
                                        <td>{{ $purchase->PricePerUnit }}</td>
                                        <td>{{ $purchase->Total }}</td>
                                        <td>{{ $purchase->PurchaseDate }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Back to Products List</a>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
