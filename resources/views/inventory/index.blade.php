<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Inventory List') }}
                <a href="{{ route('inventory.create') }}" class="btn btn-primary float-end">Add Inventory</a>
            </h2>
        </x-slot>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container mt-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Note: Manually track and manage your Inventory of Products here.</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Contract ID</th>
                                            {{-- <th>Invoice ID</th> --}}
                                            <th>Invoice Number</th>
                                            <th>Supplier</th>
                                            <th>Product Name</th>
                                            <th>Category</th>
                                            <th>Amount</th>
                                            {{-- <th>Quantity</th> --}}
                                            <th>Extra Expense</th>
                                            <th>Description</th>
                                            <th>Last Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($inventories as $inventory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $inventory->invoice->contract->ContractID }}</td>
                                            {{-- <td>{{ $inventory->InvoiceID }}</td> --}}
                                            <td>{{ $inventory->invoice->InvoiceNumber }}</td>
                                            <td>{{ $inventory->invoice->contract->supplier->CompanyName }}</td>
                                            <td>{{ $inventory->invoice->contract->product->ProductName }}</td>
                                            <td>{{ $inventory->invoice->contract->product->category->Name }}</td>
                                            <td>${{ number_format($inventory->invoice->Amount, 2) }}</td>
                                            {{-- <td>${{ number_format($inventory->invoice->Quantity, 2) }}</td> --}}
                                            <td>${{ number_format($inventory->ExtraExpense, 2) }}</td>
                                            <td>{{ $inventory->Description ?? 'N/A' }}</td>
                                            <td>{{ $inventory->updated_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('inventory.edit', $inventory->InventoryID) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('inventory.destroy', $inventory->InventoryID) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No Inventory Records Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
