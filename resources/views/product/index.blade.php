<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product List') }}
            <a href="{{ route('product.create') }}" class="btn btn-primary float-end">Add Product</a>
        </h2>
    </x-slot>
    
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Note: Manage your products here</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ProductID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->ProductID }}</td>
                                    <td>{{ $product->ProductName }}</td>
                                    <td>{{ $product->category->Name }}</td> {{-- Assuming a relationship with the Category model --}}
                                    <td>{{ $product->Description }}</td>
                                    <td>
                                        <a href="{{ route('product.show', $product->ProductID) }}" class="btn btn-success">Show</a>
                                        <a href="{{ route('product.edit', $product->ProductID) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('product.destroy', $product->ProductID) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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
