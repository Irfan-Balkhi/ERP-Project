// filepath: /e:/FYP_all/paiman/resources/views/sale/edit.blade.php
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Sale</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Sale') }}
            <a href="{{ route('sale.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Sale Entry</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sale.update', $sale->SaleID) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="InvoiceNumber" class="form-label">Invoice Number</label>
                                    <input type="text" class="form-control" id="InvoiceNumber" name="InvoiceNumber" value="{{ $sale->InvoiceNumber }}" readonly required>
                                </div>
                                <input type="hidden" name="InvoiceID" id="InvoiceID" value="{{ $sale->InvoiceID }}">

                                <div class="mb-3">
                                    <label for="InventoryID">Select Inventory</label>
                                    <select name="InventoryID" id="InventoryID" class="form-control" required>
                                        @foreach ($inventories as $inventory)
                                            @if ($inventory->invoice && $inventory->invoice->contract && $inventory->invoice->contract->product)
                                                <option value="{{ $inventory->InventoryID }}"
                                                    data-invoice-id="{{ $inventory->invoice->InvoiceID }}"
                                                    data-product="{{ $inventory->invoice->contract->product->ProductName }}"
                                                    data-category="{{ $inventory->invoice->contract->product->category->Name }}"
                                                    data-quantity="{{ $inventory->invoice->Quantity }}"
                                                    data-extra-expense="{{ $inventory->ExtraExpense }}"
                                                    data-purchase-amount="{{ $inventory->invoice->Amount }}"
                                                    {{ $inventory->InventoryID == $sale->InventoryID ? 'selected' : '' }}>
                                                    {{ $inventory->invoice->contract->product->ProductName }} (Available: {{ $inventory->invoice->Quantity }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Customer Name</label>
                                    <input type="text" id="CustomerName" class="form-control" name="CustomerName" value="{{ $sale->CustomerName }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Sale Price (Per Unit)</label>
                                    <input type="number" step="0.01" name="PricePerUnit" id="PricePerUnit" class="form-control" value="{{ $sale->PricePerUnit }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Quantity Sold</label>
                                    <input type="number" name="Quantity" id="Quantity" class="form-control" value="{{ $sale->Quantity }}" required>
                                </div>

                                <div class="mb-3">
                                    <label>Total Sale Amount</label>
                                    <input type="number" step="0.01" name="Total" id="Total" class="form-control" value="{{ $sale->Total }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="PurchasedUnit" class="form-label">Purchased Unit</label>
                                    <select name="PurchasedUnit" id="PurchasedUnit" class="form-control" required>
                                        <option>TON</option>
                                        <option>Wagon</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="SaleDate" class="form-label">Sale Date</label>
                                    <input type="date" name="SaleDate" id="SaleDate" class="form-control" value="{{ $sale->SaleDate }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea name="Description" id="Description" class="form-control" rows="3">{{ $sale->Description }}</textarea>
                                </div>

                                <script>
                                    document.getElementById('PricePerUnit').addEventListener('input', calculateTotal);
                                    document.getElementById('Quantity').addEventListener('input', calculateTotal);

                                    function calculateTotal() {
                                        let price = parseFloat(document.getElementById('PricePerUnit').value) || 0;
                                        let quantity = parseFloat(document.getElementById('Quantity').value) || 0;
                                        document.getElementById('Total').value = (price * quantity).toFixed(2);
                                    }
                                </script>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Update Sale</button>
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
