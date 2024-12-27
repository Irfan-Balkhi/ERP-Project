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
                                        <th>Inventory ID</th>
                                        <th>Purchase ID</th>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Purchased Price</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($inventories as $inventory)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $inventory->InventoryID }}</td>
                                        <td>{{ $inventory->PurchaseID }}</td>
                                        <td>{{ $inventory->ProductID }}</td>
                                        <td>{{ $inventory->ProductName }}</td>
                                        <td>{{ $inventory->Quantity }}</td>
                                        <td>{{ $inventory->TotalPurchasedPrice }}</td>
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
    </x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
