<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Invoice') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoice.store') }}" method="POST">
                        @csrf

                        <!-- Invoice Number -->
                        {{-- <div class="mb-3">
                            <label for="InvoiceNumber" class="form-label">Invoice Number</label>
                            <input type="text" name="InvoiceNumber" id="InvoiceNumber" class="form-control" required>
                        </div> --}}

                        <div class="mb-3">
                            <label for="InvoiceNumber" class="form-label">Invoice Number</label>
                            <input type="text" class="form-control" id="InvoiceNumber" name="InvoiceNumber" readonly required>
                        </div>

                        <!-- Invoice Type -->
                        <div class="mb-3">
                            <label for="InvoiceType" class="form-label">Invoice Type</label>
                            <select name="InvoiceType" id="InvoiceType" class="form-control" required>
                                <option value="internal">Internal</option>
                                <option value="external">External</option>
                            </select>
                        </div>

                        <!-- Invoice Source -->
                        <div class="mb-3">
                            <label for="InvoiceSource" class="form-label">Invoice Source</label>
                            <select name="InvoiceSource" id="InvoiceSource" class="form-control" required>
                                <option value="Purchase">Purchase</option>
                                <option value="Sale">Sale</option>
                                <option value="Transaction">Transaction</option>
                            </select>
                        </div>

                        <!-- Contract (Appears only if 'Purchase' is selected) -->
                        <div class="mb-3" id="contractField" style="display: none;">
                            <label for="ContractID" class="form-label">Contract</label>
                            <select name="ContractID" id="ContractID" class="form-control">
                                <option value="">-- Select Contract --</option>
                                @foreach ($contracts as $contract)
                                    <option value="{{ $contract->ContractID }}">{{ $contract->ContractID }} - {{ $contract->TotalValue }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Invoice Date -->
                        <div class="mb-3">
                            <label for="Date" class="form-label">Invoice Date</label>
                            <input type="date" name="Date" id="Date" class="form-control" required>
                        </div>

                        <!-- Payment Method (Only for external invoices) -->
                        <div class="mb-3" id="paymentMethodField" style="display: none;">
                            <label for="PaymentMethod" class="form-label">Payment Method</label>
                            <input type="text" name="PaymentMethod" id="PaymentMethod" class="form-control">
                        </div>

                        <!-- Amount -->
                        <div class="mb-3">
                            <label for="Amount" class="form-label">Price Per Unit</label>
                            <input type="number" step="0.01" name="Amount" id="Amount" class="form-control">
                        </div>

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="Quantity" class="form-label">Quantity</label>
                            <input type="number" step="0.01" name="Quantity" id="Quantity" class="form-control">
                        </div>

                        <!-- Total Amount -->
                        <div class="mb-3">
                            <label for="TotalAmount" class="form-label">Total Amount</label>
                            <input type="number" step="0.01" name="TotalAmount" id="TotalAmount" class="form-control">
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="Description" class="form-label">Description</label>
                            <textarea name="Description" id="Description" class="form-control" rows="3"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Save Invoice</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
        // Show/hide Contract field based on InvoiceSource selection
        $('#InvoiceSource').change(function () {
            if ($(this).val() === 'Purchase') {
                $('#contractField').show();
            } else {
                $('#contractField').hide();
            }
        });

        // Show/hide PaymentMethod field based on InvoiceType selection
        $('#InvoiceType').change(function () {
            if ($(this).val() === 'external') {
                $('#paymentMethodField').show();
            } else {
                $('#paymentMethodField').hide();
            }
        });
    });
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
    
     // Update `Total` on input
     document.getElementById('Amount').addEventListener('input', calculateTotal);
            document.getElementById('Quantity').addEventListener('input', calculateTotal);

        function calculateTotal() {
            let price = parseFloat(document.getElementById('Amount').value) || 0;
            let quantity = parseFloat(document.getElementById('Quantity').value) || 0;
            document.getElementById('TotalAmount').value = ((price * quantity)).toFixed(2);
        }
    </script>




</body>
</html>
