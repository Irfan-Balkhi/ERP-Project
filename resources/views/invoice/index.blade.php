<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
<x-app-layout>
    {{-- <div class="container mx-auto px-4 mt-12"> --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoices List') }}
            <a href="{{ route('invoice.create') }}" class="btn btn-primary float-end ">Add Invoice</a>

        </h2>
    </x-slot>
    
    {{-- @section('content') --}}
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
                                        <th>Number</th>
                                        <th>Invoice Number</th>
                                        <th>Invoice Type</th>
                                        <th>Source</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $invoice->id }}</td>
                                            <td>{{ $invoice->InvoiceNumber }}</td>
                                            <td>{{ $invoice->InvoiceType }}</td>
                                            <td>{{ $invoice->Source }}</td>
                                            <td>{{ $invoice->Amount }}</td>
                                            <td>{{ $invoice->Description }}</td>
                                            <td>
                                                <a href="{{ route('invoice.show', $invoice->id)}}" class="btn btn-success">Show</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>