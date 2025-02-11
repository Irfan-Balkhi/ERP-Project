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
            {{ __('Purchases List') }}
            <a href="{{ route('purchase.create') }}" class="btn btn-primary float-end ">Add Purchase</a>

        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: add the complete record of your purchase here</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>PurchaseID</th> --}}
                                        <th>Invoice Number</th>
                                        <th>Supplier Name</th>
                                        <th>Category Name</th>
                                        {{-- <th>Product Name</th> --}}
                                        {{-- <th>Purchase Date</th> --}}
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        {{-- <th>PricePerUnit</th> --}}
                                        {{-- <th>Total</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>{{ $purchase->PurchaseID }}</td> --}}
                                        <td>{{ $purchase->InvoiceNumber }}</td>
                                        <td>{{ $purchase->SellerName }}</td>
                                        <td>{{ $purchase->category ? $purchase->category->Name : 'N/A' }}</td>
                                        {{-- <td>{{ $purchase->product->ProductName ?? 'N/A' }}</td>  --}}
                                        {{-- <td>
                                            @if($purchase->product->isNotEmpty())
                                                @foreach($purchase->products as $product)
                                                    {{ $product->ProductName }}{{ !$loop->last ? ', ' : '' }}
                                                @endforeach
                                            @else
                                                N/A
                                            @endif
                                        </td>       --}}
                                        {{-- <td>{{ $purchase->products->isNotEmpty() ? $purchase->products->first()->ProductName : 'N/A' }}</td> --}}
                                        {{-- <td>{{ $purchase->ProductID}}</td> --}}
                                        {{-- <td>{{ $purchase->PurchaseDate }}</td> --}}
                                        <td>{{ $purchase->Description }}</td>
                                        <td>{{ $purchase->Quantity }}</td>
                                        {{-- <td>{{ $purchase->PricePerUnit }}</td> --}}
                                        {{-- <td>{{ $purchase->Total }}</td> --}}
                                        <td>
                                            <a href="{{ route('purchase.show', $purchase->InvoiceNumber) }}" class="btn btn-success">Show</a>
                                            <a href="{{ route('purchase.edit', $purchase->PurchaseID) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('purchase.destroy', $purchase->PurchaseID) }}" method="POST" id="delete-form-{{ $purchase->PurchaseID }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $purchase->PurchaseID }}')" class="btn btn-danger btn-sm">Delete</button>
                                            </form>  
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $purchases->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @section('content') --}}
        
        
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>