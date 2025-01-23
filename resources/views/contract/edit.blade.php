<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Contract</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Contract') }}
            <a href="{{ route('contract.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Contract Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('contract.update', $contract->ContractID) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="SupplierID" class="form-label">Supplier</label>
                            <select name="SupplierID" id="SupplierID" class="form-control" required>
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->SupplierID }}" 
                                        {{ $supplier->SupplierID == $contract->SupplierID ? 'selected' : '' }}>
                                        {{ $supplier->CompanyName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="TotalValue" class="form-label">Total Value</label>
                            <input type="number" name="TotalValue" id="TotalValue" class="form-control" value="{{ $contract->TotalValue }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="TotalQuantity" class="form-label">Total Quantity</label>
                            <input type="number" name="TotalQuantity" id="TotalQuantity" class="form-control" value="{{ $contract->TotalQuantity }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="ContractAttachment" class="form-label">Contract Attachment</label>
                            @if ($contract->ContractAttachment)
                                <p>Current Attachment: 
                                    <a href="{{ asset('storage/attachments/' . $contract->ContractAttachment) }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                                </p>
                            @endif
                            <input type="file" name="ContractAttachment" id="ContractAttachment" class="form-control">
                            <small class="text-muted">Leave blank to keep the current attachment.</small>
                        </div>

                        <div class="mb-3">
                            <label for="StartDate" class="form-label">Start Date</label>
                            <input type="date" name="StartDate" id="StartDate" class="form-control" value="{{ $contract->StartDate }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="EndDate" class="form-label">End Date</label>
                            <input type="date" name="EndDate" id="EndDate" class="form-control" value="{{ $contract->EndDate }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Contract</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
