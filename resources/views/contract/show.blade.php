<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contract Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contract Details') }}
            <a href="{{ route('contract.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <!-- Contract Details -->
                    <div class="card">
                        <div class="card-header">
                            <h4>Contract Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Contract ID</th>
                                        <td>{{ $contract->ContractID }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Supplier Name</th>
                                        <td>{{ $contract->supplier->CompanyName ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Value</th>
                                        <td>$ {{ $contract->TotalValue }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Quantity</th>
                                        <td>{{ $contract->TotalQuantity }} -TON</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Start Date</th>
                                        <td>{{ $contract->StartDate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">End Date</th>
                                        <td>{{ $contract->EndDate }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contract Attachment</th>
                                        <td>
                                            @if ($contract->ContractAttachment)
                                                <a href="{{ asset('storage/attachments/' . $contract->ContractAttachment) }}" target="_blank" class="btn btn-outline-primary">View Attachment</a>
                                            @else
                                                No Attachment
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Related Invoices -->
                    <div class="card mt-4">
                        <div class="card-header">
                            <h4>Related Invoices</h4>
                        </div>
                        <div class="card-body">
                            {{-- @if ($contract->invoices->isEmpty())
                                <p>No invoices found for this contract.</p>
                            @else --}}
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice Number</th>
                                            <th>Amount</th>
                                            <th>Issue Date</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach ($contract->invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $invoice->InvoiceID }}</td>
                                            <td>{{ $invoice->InvoiceNumber }}</td>
                                            <td>$ {{ $invoice->Amount }}</td>
                                            <td>{{ $invoice->IssueDate }}</td>
                                            <td>{{ $invoice->Status }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}}
                                </table>
                            {{-- @endif --}}
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
