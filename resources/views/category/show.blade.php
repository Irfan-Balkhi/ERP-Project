<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products of  "')}} {{ $category->Name }} {{ __('"  Category')}}
            <a href="{{ route('category.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Products List</h4>
                        </div>
                        <div class="card-body">
                            @if ($category->products->isEmpty())
                                <p>No products found for this category.</p>
                            @else
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ProductID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            {{-- <th>Price</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->ProductID }}</td>
                                            <td>{{ $product->ProductName }}</td>
                                            <td>{{ $product->Description }}</td>
                                            {{-- <td>{{ $product->Price }}</td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
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
