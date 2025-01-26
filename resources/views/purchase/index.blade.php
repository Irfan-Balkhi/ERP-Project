<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Purchase List') }}
            <a href="{{ route('purchase.create') }}" class="btn btn-primary float-end">Add Purchase</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Contract</th>
                                <th>Supplier</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Purchase Date</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $purchase->contract->ContractID ?? 'No Contract' }}</td>
                                <td>{{ $purchase->supplier->CompanyName ?? 'No Supplier' }}</td>
                                <td>{{ $purchase->product->ProductName ?? 'No Product' }}</td>
                                <td>{{ $purchase->category->Name ?? 'No Category' }}</td>
                                <td>{{ $purchase->PurchaseDate }}</td>
                                <td>{{ $purchase->Description }}</td>
                                <td>
                                    <a href="{{ route('purchase.show', $purchase->PurchaseID) }}" class="btn btn-success btn-sm">View</a>
                                    <a href="{{ route('purchase.edit', $purchase->PurchaseID) }}" class="btn btn-warning btn-sm">Edit</a>
                                   
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
</x-app-layout>
</body>
</html>
