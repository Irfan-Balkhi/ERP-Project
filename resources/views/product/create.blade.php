<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Product') }}
            <a href="{{ route('product.index') }}" class="btn btn-danger float-end">Back</a>
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Note: Add the complete details of your product here</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="ProductName">Product Name</label>
                                <input type="text" name="ProductName" id="ProductName" class="form-control" placeholder="Enter Product Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="CategoryID">Category</label>
                                <select name="CategoryID" id="CategoryID" class="form-control" required>
                                    <option value="" disabled selected>Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->CategoryID }}">{{ $category->Name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="Description">Description</label>
                                <textarea name="Description" id="Description" class="form-control" placeholder="Enter Description (Optional)"></textarea>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
