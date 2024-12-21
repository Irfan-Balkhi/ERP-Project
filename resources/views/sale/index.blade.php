<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sales List') }}
            <a href="{{ route('sale.create') }}" class="btn btn-primary float-end">Add Sale</a>
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Note: Add the complete record of your sales here</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Invoice Number</th>
                                    <th>Customer Name</th>
                                    <th>Category ID</th>
                                    <th>Sale Date</th>
                                    <th>Description</th>
                                    <th>Purchased Unit</th>
                                    <th>Quantity</th>
                                    <th>Price Per Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td> 
                                    <td>{{ $sale->InvoiceNumber }}</td>
                                    <td>{{ $sale->CustomerName }}</td>
                                    <td>{{ $sale->CategoryID }}</td>
                                    <td>{{ $sale->SaleDate }}</td>
                                    <td>{{ $sale->Description }}</td>
                                    <td>{{ $sale->PurchasedUnit }}</td>
                                    <td>{{ $sale->Quantity }}</td>
                                    <td>{{ $sale->PricePerUnit }}</td>
                                    <td>{{ $sale->Total }}</td>
                                    <td>
                                        <a href="{{ route('sale.show', $sale->InvoiceNumber) }}" class="btn btn-success">Show</a>
                                        {{-- <a href="{{ route('sale.edit', $sale->InvoiceNumber) }}" class="btn btn-warning">Edit</a> --}}
                                        {{-- <form action="{{ route('sale.destroy', $sale->InvoiceNumber) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form> --}}
                                    </td>
                               </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
