<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Inventory') }}
            <a href="{{ route('inventory.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: Update the additional expenses for this inventory record.</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('inventory.update', $inventory->InventoryID) }}" method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Read-Only Details --}}
                                <div class="mb-3">
                                    <label for="ContractID" class="form-label">Contract ID</label>
                                    <input type="text" class="form-control" value="{{ $inventory->invoice->contract->ContractID }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="InvoiceNumber" class="form-label">Invoice Number</label>
                                    <input type="text" class="form-control" value="{{ $inventory->invoice->InvoiceNumber }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="SupplierName" class="form-label">Supplier</label>
                                    <input type="text" class="form-control" value="{{ $inventory->invoice->contract->supplier->CompanyName }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="ProductName" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" value="{{ $inventory->invoice->contract->product->ProductName }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="CategoryName" class="form-label">Category</label>
                                    <input type="text" class="form-control" value="{{ $inventory->invoice->contract->product->category->Name }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="Price" class="form-label">Price</label>
                                    <input type="text" class="form-control" value="${{ number_format($inventory->invoice->Amount, 2) }}" readonly>
                                </div>

                                {{-- Editable Fields --}}
                                <div class="mb-3">
                                    <label for="ExtraExpense" class="form-label">Extra Expense</label>
                                    <input type="number" step="0.01" class="form-control" name="ExtraExpense" id="ExtraExpense" value="{{ $inventory->ExtraExpense }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="Description" class="form-label">Description (Optional)</label>
                                    <textarea class="form-control" name="Description" id="Description" rows="3">{{ $inventory->Description }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update Inventory</button>
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
