<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Sale') }}
            <a href="{{ route('sale.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: Add the complete record of your sale here</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sale.store') }}" method="POST">
                                @csrf
    
                                <div class="mb-3">
                                    <label for="">Invoice Number</label>
                                    <input type="text" name="InvoiceNumber" value="{{ 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6)) }}" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="">Customer Name</label>
                                    <input type="text" name="CustomerName" class="form-control" placeholder="Enter Customer Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ProductID">Product</label>
                                    <select name="ProductID" id="ProductID" class="form-control" required>
                                        <option value="" disabled selected>Select a Product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->ProductID }}">{{ $product->ProductName }} (Available: {{ $product->Quantity }})</option>
                                        @endforeach
                                    </select>
                                    <!-- Display error message for Product -->
                                    @error('ProductID')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="CategoryID">Category ID</label>
                                    <select name="CategoryID" id="CategoryID" class="form-control">
                                        <option value="" disabled selected>Select a Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="mb-3">
                                    <label for="">Sale Date</label>
                                    <input type="date" name="SaleDate" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <textarea name="Description" class="form-control" placeholder="Enter Description (Optional)"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Purchased Unit</label>
                                    <input type="text" name="PurchasedUnit" class="form-control" placeholder="Enter Purchased Unit" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Quantity</label>
                                    <input type="number" name="Quantity" class="form-control" placeholder="Enter Quantity" required>
                                    @error('Quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Price Per Unit</label>
                                    <input type="number" step="0.01" name="PricePerUnit" class="form-control" placeholder="Enter Price Per Unit" required>
                                </div>
                                <div class="mb-3">
                                    <label for="">Total</label>
                                    <input type="number" step="0.01" name="Total" class="form-control" placeholder="Total Amount">
                                </div>
    
                                {{-- Optional: JavaScript for calculating total --}}
                                <script>
                                    const quantityInput = document.getElementById('Quantity');
                                    const priceInput = document.getElementById('PricePerUnit');
                                    const totalInput = document.getElementById('Total');
                                
                                    function calculateTotal() {
                                        const quantity = parseFloat(quantityInput.value) || 0;
                                        const price = parseFloat(priceInput.value) || 0;
                                        totalInput.value = (quantity * price).toFixed(2);
                                    }
                                
                                    quantityInput.addEventListener('input', calculateTotal);
                                    priceInput.addEventListener('input', calculateTotal);
                                </script>
    
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
