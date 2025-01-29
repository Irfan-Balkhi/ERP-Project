<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoices List') }}
            <a href="{{ route('invoice.create') }}" class="btn btn-primary float-end ">Add Invoice</a>

        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: for perviuos Record / External Invoice Number use the add option</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice Number</th>
                                        <th>Type</th>
                                        <th>Source</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Payment Method</th>
                                        <th>Related ID</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $invoice->InvoiceNumber }}</td>
                                            <td>{{ ucfirst($invoice->InvoiceType) }}</td>
                                            <td>{{ ucfirst($invoice->InvoiceSource) }}</td>
                                            <td>{{ $invoice->Date }}</td>
                                            <td>{{ $invoice->TotalAmount ?? 'N/A' }}</td>
                                            <td>{{ $invoice->PaymentMethod ?? 'N/A' }}</td>
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
                                            <td>
                                                <a href="{{ route('invoice.show', $invoice->InvoiceID) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('invoice.edit', $invoice->InvoiceID) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('invoice.destroy', $invoice->InvoiceID) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No invoices found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
        
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>