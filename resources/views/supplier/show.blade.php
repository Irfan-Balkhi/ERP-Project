<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Supplier Details') }}
            <a href="{{ route('supplier.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <!-- Supplier Details -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Supplier Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Company Name</th>
                                        <td>{{ $supplier->CompanyName }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>{{ $supplier->CompanyEmail }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contact Number</th>
                                        <td>{{ $supplier->CompanyContactNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Address</th>
                                        <td>{{ $supplier->Address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Related Contracts -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Related Contracts</h4>
                        </div>
                        <div class="card-body">
                            @if ($supplier->contracts->isEmpty())
                                <p>No contracts found for this supplier.</p>
                            @else
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Contract ID</th>
                                            <th>Total Value</th>
                                            <th>Total Quantity</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplier->contracts as $contract)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $contract->ContractID }}</td>
                                            <td>$ {{ $contract->TotalValue }}</td>
                                            <td>{{ $contract->TotalQuantity }} -TON</td>
                                            <td>{{ $contract->StartDate }}</td>
                                            <td>{{ $contract->EndDate }}</td>
                                            <td>
                                                <a href="{{ route('contract.show', $contract->ContractID) }}" class="btn btn-success btn-sm">Show</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
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
