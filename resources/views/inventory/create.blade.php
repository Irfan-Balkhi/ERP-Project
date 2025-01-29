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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- Centering the content --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: Add the extra expenses related to an invoice</h4>
                        </div>
                        <div class="card-body">
                            <!-- Display validation errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('inventory.store') }}" method="POST">
                                @csrf

                                <!-- Select Contract -->
                                <div class="mb-3">
                                    <label for="ContractID" class="form-label">Select Contract</label>
                                    <select id="ContractID" class="form-select" required>
                                        <option value="">-- Select Contract --</option>
                                        @foreach ($contracts as $contract)
                                            <option value="{{ $contract->ContractID }}">{{ $contract->ContractID }} - {{ $contract->supplier->CompanyName }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Select Invoice -->
                                <div class="mb-3">
                                    <label for="InvoiceID" class="form-label">Select Invoice</label>
                                    <select name="InvoiceID" id="InvoiceID" class="form-select" required>
                                        <option value="">-- Select Invoice --</option>
                                    </select>
                                </div>

                                <!-- Extra Expense -->
                                <div class="mb-3">
                                    <label for="ExtraExpense" class="form-label">Extra Expense</label>
                                    <input type="number" step="0.01" class="form-control" name="ExtraExpense" id="ExtraExpense" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="Description" class="form-label">Description (Optional)</label>
                                    <textarea class="form-control" name="Description" id="Description" rows="3"></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save Inventory</button>
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
<script>
    document.getElementById('ContractID').addEventListener('change', function() {
        let contractID = this.value;
        let invoiceSelect = document.getElementById('InvoiceID');
        invoiceSelect.innerHTML = '<option value="">-- Select Invoice --</option>';

        if (contractID) {
            fetch(`/get-invoices/${contractID}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(invoice => {
                        let option = document.createElement('option');
                        option.value = invoice.InvoiceID;
                        option.textContent = invoice.InvoiceNumber;
                        invoiceSelect.appendChild(option);
                    });
                });
        }
    });
</script>
</body>
</html>
