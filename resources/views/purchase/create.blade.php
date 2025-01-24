<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Purchase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Purchase') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Purchase</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('purchase.store') }}" method="POST">
                        @csrf
                        <!-- Contract Selection -->
                        <div class="mb-3">
                            <label for="ContractID" class="form-label">Contract</label>
                            <select name="ContractID" id="ContractID" class="form-control" required>
                                <option value="">-- Select Contract --</option>
                                @foreach ($contracts as $contract)
                                    <option value="{{ $contract->ContractID }}">{{ $contract->ContractID }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Supplier Name -->
                        {{-- <div class="mb-3">
                            <label for="SupplierName" class="form-label">Supplier</label>
                            <input type="text" id="SupplierName" class="form-control" readonly>
                        </div> --}}
                        <!-- Supplier Name (Display Only) -->
                        <div class="mb-3">
                            <label for="SupplierName" class="form-label">Supplier</label>
                            <input type="text" id="SupplierName" class="form-control" readonly>
                        </div>
                        {{-- 'SupplierID' => 'required|exists:suppliers,SupplierID', --}}


                        <!-- Hidden SupplierID Field -->
                        <input type="hidden" name="SupplierID" id="SupplierID">

                        <!-- Category Selection -->
                        <div class="mb-3">
                            <label for="CategoryID" class="form-label">Category</label>
                            <select name="CategoryID" id="CategoryID" class="form-control" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Product Selection -->
                        <div class="mb-3">
                            <label for="ProductID" class="form-label">Product</label>
                            <select name="ProductID" id="ProductID" class="form-control" required>
                                <option value="">-- Select Product --</option>
                            </select>
                        </div>

                        <!-- Purchase Date -->
                        <div class="mb-3">
                            <label for="PurchaseDate" class="form-label">Purchase Date</label>
                            <input type="date" name="PurchaseDate" id="PurchaseDate" class="form-control" required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="Description" class="form-label">Description</label>
                            <textarea name="Description" id="Description" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Fetch supplier name when contract is selected
    $('#ContractID').change(function () {
        const contractId = $(this).val();
        if (contractId) {
            $.ajax({
                url: `/contracts/${contractId}/supplier`,
                method: 'GET',
                success: function (response) {
                    $('#SupplierName').val(response.CompanyName || 'No Supplier Found');
                    $('#SupplierID').val(response.SupplierID || ''); // Populate the hidden SupplierID field
                },
                error: function () {
                    $('#SupplierName').val('Error fetching supplier');
                    $('#SupplierID').val(''); // Clear the SupplierID field on error
                }
            });
        } else {
            $('#SupplierName').val('');
            $('#SupplierID').val(''); // Clear the SupplierID field if no contract is selected
        }
    });


    // Fetch products when category is selected
    $('#CategoryID').change(function () {
        const categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: `/categories/${categoryId}/products`,
                method: 'GET',
                success: function (response) {
                    $('#ProductID').empty().append('<option value="">-- Select Product --</option>');
                    response.forEach(function (product) {
                        $('#ProductID').append(`<option value="${product.ProductID}">${product.ProductName}</option>`);
                    });
                },
                error: function () {
                    $('#ProductID').empty().append('<option value="">Error fetching products</option>');
                }
            });
        } else {
            $('#ProductID').empty().append('<option value="">-- Select Product --</option>');
        }
    });
</script>
</body>
</html>
