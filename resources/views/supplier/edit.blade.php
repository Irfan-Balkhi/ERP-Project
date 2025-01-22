<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Supplier') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('supplier.update', $supplier->SupplierID) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="CompanyName">Company Name</label>
                            <input type="text" name="CompanyName" id="CompanyName" class="form-control" value="{{ old('CompanyName', $supplier->CompanyName) }}" required>
                            @error('CompanyName')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="CompanyEmail">Company Email</label>
                            <input type="email" name="CompanyEmail" id="CompanyEmail" class="form-control" value="{{ old('CompanyEmail', $supplier->CompanyEmail) }}" required>
                            @error('CompanyEmail')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="CompanyContactNumber">Contact Number</label>
                            <input type="text" name="CompanyContactNumber" id="CompanyContactNumber" class="form-control" value="{{ old('CompanyContactNumber', $supplier->CompanyContactNumber) }}" required>
                            @error('CompanyContactNumber')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="Address">Address</label>
                            <textarea name="Address" id="Address" class="form-control" rows="4" required>{{ old('Address', $supplier->Address) }}</textarea>
                            @error('Address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update Supplier</button>
                            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
