<!-- filepath: /e:/FYP_all/paiman/resources/views/sale/create.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Sale</title>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sale Entry</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('sale.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="InvoiceNumber" class="form-label">Invoice Number</label>
                                    <input type="text" class="form-control" id="InvoiceNumber" name="InvoiceNumber" readonly required>
                                </div>
                                <input type="hidden" name="InvoiceID" id="InvoiceID">


                                <!-- Fetch Data from Inventory (Linked via Invoice -> Contract -> Product) -->
                                <div class="mb-3">
                                    <label for="InventoryID">Select Inventory</label>
                                    <select name="InventoryID" id="InventoryID" class="form-control" required>
                                        <option value="" disabled selected>Select an Inventory Item</option>
                                        @foreach ($inventories as $inventory)
                                            @if ($inventory->invoice && $inventory->invoice->contract && $inventory->invoice->contract->product)
                                                <option value="{{ $inventory->InventoryID }}" 
                                                    data-invoice-id="{{ $inventory->invoice->InvoiceID }}" 
                                                    data-product="{{ $inventory->invoice->contract->product->ProductName }}"
                                                    data-category="{{ $inventory->invoice->contract->product->category->Name }}"
                                                    data-quantity="{{ ($inventory->invoice->Quantity) }}"
                                                    data-extra-expense="{{ $inventory->ExtraExpense }}"
                                                    data-purchase-amount="{{ $inventory->invoice->Amount }}">  <!-- Fix this line -->
                                                    {{ $inventory->invoice->contract->product->ProductName }} (Available: {{ $inventory->invoice->Quantity }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>CustomerName</label>
                                    <input type="text" id="CustomerName" class="form-control" name="CustomerName" required>
                                </div>

                                <div class="mb-3">
                                    <label>Product Name</label>
                                    <input type="text" id="ProductName" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label>Category Name</label>
                                    <input type="text" id="CategoryName" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label>Available Quantity</label>
                                    <input type="number" id="AvailableQuantity" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label>Purchased Amount</label>
                                    <input type="number" id="PurchaseAmount" class="form-control" readonly>
                                </div>

                                <div class="mb-3">
                                    <label>Extra Expenses</label>
                                    <input type="number" id="ExtraExpense" class="form-control" readonly>
                                </div>

                                <!-- User Inputs -->
                                <div class="mb-3">
                                    <label>Sale Price (Per Unit)</label>
                                    <input type="number" step="0.01" name="PricePerUnit" id="PricePerUnit" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Quantity Sold</label>
                                    <input type="number" name="Quantity" id="Quantity" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Total Sale Amount</label>
                                    <input type="number" step="0.01" name="Total" id="Total" class="form-control" readonly>
                                </div>
                                
                                <!-- PurchasedUnit -->
                                {{-- <div class="mb-3">
                                    <label for="PurchasedUnit" class="form-label">Purchased Unit</label>
                                    <textarea type="text" name="PurchasedUnit" id="PurchasedUnit" class="form-control" rows="1"></textarea>
                                </div> --}}
                                <div class="mb-3">
                                    <label for="PurchasedUnit" class="form-label">Purchased Unit</label>
                                    <select name="PurchasedUnit" id="PurchasedUnit" class="form-control" required>
                                        <option value="TON">TON</option>
                                        <option value="Wagon">Wagon</option>
                                    </select>
                                </div>

                                {{-- sale date --}}
                                <div class="mb-3">
                                    <label for="SaleDate" class="form-label">Sale Date</label>
                                    <input type="date" name="SaleDate" id="SaleDate" class="form-control" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="Description" class="form-label">Description</label>
                                    <textarea name="Description" id="Description" class="form-control" rows="3"></textarea>
                                </div>


                                <!-- JavaScript for Auto-Filling & Calculating Total -->
                                <script>
                                    document.getElementById('InventoryID').addEventListener('change', function() {
                                        let selectedOption = this.options[this.selectedIndex];
                                        document.getElementById('ProductName').value = selectedOption.getAttribute('data-product');
                                        document.getElementById('CategoryName').value = selectedOption.getAttribute('data-category');
                                        document.getElementById('AvailableQuantity').value = selectedOption.getAttribute('data-quantity');
                                        document.getElementById('ExtraExpense').value = selectedOption.getAttribute('data-extra-expense');
                                        document.getElementById('PurchaseAmount').value = selectedOption.getAttribute('data-purchase-amount');
                                        document.getElementById('InvoiceID').value = selectedOption.getAttribute('data-invoice-id'); // Add this
                                    });

                                    // Update `Total` on input
                                    document.getElementById('PricePerUnit').addEventListener('input', calculateTotal);
                                    document.getElementById('Quantity').addEventListener('input', calculateTotal);

                                    function calculateTotal() {
                                        let price = parseFloat(document.getElementById('PricePerUnit').value) || 0;
                                        let quantity = parseFloat(document.getElementById('Quantity').value) || 0;
                                        let extraExpense = parseFloat(document.getElementById('ExtraExpense').value) || 0;
                                        document.getElementById('Total').value = ((price * quantity) + extraExpense).toFixed(2);
                                    }

                                    document.addEventListener('DOMContentLoaded', () => {
                                        const invoiceNumberField = document.getElementById('InvoiceNumber');

                                        // Function to generate a default Invoice Number
                                        const generateInvoiceNumber = () => {
                                            const date = new Date();
                                            const day = String(date.getDate()).padStart(2, '0');
                                            const month = String(date.getMonth() + 1).padStart(2, '0');
                                            const year = String(date.getFullYear()).slice(-2);
                                            const randomString = Math.random().toString(36).substring(2, 6).toUpperCase(); // Random 4-character string
                                            return `INV-${day}${month}${year}-${randomString}`;
                                        };

                                        // Initialize Invoice Number (only if it's empty)
                                        if (!invoiceNumberField.value) {
                                            invoiceNumberField.value = generateInvoiceNumber();
                                        }
                                    });
                                </script>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save Sale</button>
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