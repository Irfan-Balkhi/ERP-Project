<!-- filepath: resources/views/sale/index.blade.php -->
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('sale.index') }}" method="GET" class="form-inline justify-center d-flex">
                                {{-- Search by Invoice Number --}}
                                <input type="text" name="InvoiceNumber" value="{{ request('InvoiceNumber') }}" 
                                    class="form-control mr-2" placeholder="Search Invoice Number" style="background-color: rgb(240, 240, 240)">
                    
                                {{-- Search by Customer Name --}}
                                <input type="text" name="CustomerName" value="{{ request('CustomerName') }}" 
                                    class="form-control mr-2" placeholder="Search Customer Name" style="background-color: rgb(240, 240, 240)">
                    
                                {{-- Search by Product Name --}}
                                <input type="text" name="ProductName" value="{{ request('ProductName') }}" 
                                    class="form-control mr-2" placeholder="Search Product Name" style="background-color: rgb(240, 240, 240)">
                    
                                {{-- Search by Sale Date --}}
                                <input type="date" name="SaleDate" value="{{ request('SaleDate') }}" 
                                    class="form-control mr-2" style="background-color: rgb(240, 240, 240)">
                    
                                {{-- Search by Total Price --}}
                                <input type="number" name="Total" value="{{ request('Total') }}" step="0.01" 
                                    class="form-control mr-2" placeholder="Search Total Price" style="background-color: rgb(240, 240, 240)">
                    
                                {{-- Filter Button --}}
                                <button type="submit" class="btn btn-primary">Filter</button>
                    
                                {{-- Clear Filters --}}
                                <a href="{{ route('sale.index') }}" class="btn btn-secondary ml-2">Clear</a>
                            </form>
                        </div>
                    </div>
                    

                    <div class="card">
                        <div class="card-header">
                            <h4>Sales Record</h4>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice Number</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Sale Date</th>
                                        <th>Description</th>
                                        {{-- <th>Purchased Unit</th> --}}
                                        {{-- <th>Quantity</th> --}}
                                        {{-- <th>Price Per Unit</th> --}}
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> 
                                        <td>{{ $sale->InvoiceNumber }}</td>
                                        <td>{{ $sale->CustomerName }}</td>
                                        <td>{{ $sale->inventory->invoice->contract->product->ProductName ?? 'N/A' }}</td>
                                        <td>{{ $sale->SaleDate }}</td>
                                        <td>{{ $sale->Description }}</td>
                                        {{-- <td>{{ $sale->PurchasedUnit }}</td> --}}
                                        {{-- <td>{{ $sale->Quantity }}</td> --}}
                                        {{-- <td>{{ $sale->PricePerUnit }}</td> --}}
                                        <td>{{ $sale->Total }}</td>
                                        <td>
                                            <a href="{{ route('sale.show', $sale->SaleID) }}" class="btn btn-success">Show</a>
                                            <a href="{{ route('sale.edit', $sale->SaleID) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('sale.destroy', $sale->SaleID) }}" method="POST" id="delete-form-{{ $sale->SaleID }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $sale->SaleID }}')" class="btn btn-danger">Delete</button>
                                            </form>   
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $sales->links() }} <!-- Pagination -->
                            </div>
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
