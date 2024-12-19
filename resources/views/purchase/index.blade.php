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
    
    {{-- @section('content') --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Note: add the complete record of your purchase here</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-stiped table-bordered">
                                <thead>
                                    <tr>
                                        {{-- <th>#</th> --}}
                                        <th>PurchaseID</th>
                                        <th>Invoice Number</th>
                                        <th>SellerName</th>
                                        <th>CategoryID</th>
                                        <th>PurchaseDate</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>PricePerUnit</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->PurchaseID }}</td>
                                        <td>{{ $purchase->InvoiceNumber }}</td>
                                        <td>{{ $purchase->SellerName }}</td>
                                        <td>{{ $purchase->CategoryID }}</td>
                                        <td>{{ $purchase->PurchaseDate }}</td>
                                        <td>{{ $purchase->Description }}</td>
                                        <td>{{ $purchase->Quantity }}</td>
                                        <td>{{ $purchase->PricePerUnit }}</td>
                                        <td>{{ $purchase->Total }}</td>
                                        <td>
                                            <a href="{{ route('purchase.show', $purchase->InvoiceNumber) }}" class="btn btn-success">Show</a>
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