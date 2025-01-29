<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Contract</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Contract') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('contract.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="SupplierID" class="form-label">Supplier</label>
                            <select name="SupplierID" id="SupplierID" class="form-control" required>
                                <option value="" disabled selected>Select a Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->SupplierID }}">{{ $supplier->CompanyName }}</option>
                                @endforeach
                            </select>
                        </div>
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

                        <div class="mb-3">
                            <label for="TotalValue" class="form-label">Total Value</label>
                            <input type="number" name="TotalValue" id="TotalValue" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="TotalQuantity" class="form-label">Total Quantity</label>
                            <input type="number" name="TotalQuantity" id="TotalQuantity" class="form-control" required>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="ContractAttachment" class="form-label">Contract Attachment</label>
                            <input type="file" name="ContractAttachment" id="ContractAttachment" class="form-control" required>
                        </div> --}}
                        <!-- Bill Attachment -->
                        <div class="form-group">
                            <label for="ContractAttachment">Contract Attachment (PDF/JPG/PNG)</label><br>
                            <input type="file" name="ContractAttachment" id="ContractAttachment" class="form-control-file" accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                        <div class="mb-3">
                            <label for="StartDate" class="form-label">Start Date</label>
                            <input type="date" name="StartDate" id="StartDate" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="EndDate" class="form-label">End Date</label>
                            <input type="date" name="EndDate" id="EndDate" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#CategoryID').change(function () {
            let categoryId = $(this).val();
            if (categoryId) {
                $.get(`/categories/${categoryId}/products`, function (data) {
                    let productDropdown = $('#ProductID');
                    productDropdown.empty().append('<option value="">-- Select Product --</option>');
                    data.forEach(product => {
                        productDropdown.append(`<option value="${product.ProductID}">${product.ProductName}</option>`);
                    });
                });
            } else {
                $('#ProductID').empty().append('<option value="">-- Select Product --</option>');
            }
        });
    });
</script>
</body>
</html>
