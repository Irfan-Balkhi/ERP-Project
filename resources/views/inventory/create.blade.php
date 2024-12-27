<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Inventory') }}
            <a href="{{ route('inventory.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Note: Add the inventory details manually for purchased products.</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inventory.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="PurchaseID" class="form-label">Select Purchase</label>
                                <select class="form-control" id="PurchaseID" name="PurchaseID" required>
                                    <option value="" disabled selected>Select a Purchase</option>
                                    @foreach ($purchases as $purchase)
                                        <option value="{{ $purchase->PurchaseID }}">{{ $purchase->InvoiceNumber }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="ProductID" class="form-label">Select Product</label>
                                <select class="form-control" id="ProductID" name="ProductID" required>
                                    <option value="" disabled selected>Select a Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->ProductID }}">{{ $product->ProductName }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="Quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="Quantity" name="Quantity" min="1" placeholder="Enter Quantity" required>
                            </div>

                            <div class="mb-3">
                                <label for="TotalPurchasedPrice" class="form-label">Total Purchased Price</label>
                                <input type="number" step="0.01" class="form-control" id="TotalPurchasedPrice" name="TotalPurchasedPrice" placeholder="Enter Total Purchased Price" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Add to Inventory</button>
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
