<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoice Details for ') }} {{ $invoice->invoice_Num }}
        </h2>
        {{-- Pagination links --}}
{{-- {{ $invoice->links() }} --}}
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Invoice Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <td>{{ $invoice->invoice_Num }}</td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td>{{ ucfirst($invoice->InvoiceType) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Source</th>
                                        <td>{{ ucfirst($invoice->InvoiceSource) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $invoice->Date }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{ $invoice->Quantity ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price Per Unit</th>
                                        <td>{{ $invoice->Amount ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount</th>
                                        <td>{{ $invoice->TotalAmount ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Related ID</th>
                                        <td>
                                            @if ($invoice->InvoiceSource === 'Purchase')
                                                Contract #{{ $invoice->ContractID ?? 'N/A' }}
                                            @elseif ($invoice->InvoiceSource === 'Sale')
                                                Sale #{{ $invoice->SaleID ?? 'N/A' }}
                                            @elseif ($invoice->InvoiceSource === 'Transaction')
                                                Transaction #{{ $invoice->TransactionID ?? 'N/A' }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <a href="{{ route('invoice.index') }}" class="btn btn-secondary mt-3">Back to Invoices List</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
