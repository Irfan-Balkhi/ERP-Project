<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categories List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories List') }}
            <a href="{{ route('category.create') }}" class="btn btn-primary float-end">Add Category</a>
        </h2>
    </x-slot>
    
    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Note: Manage your categories here</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>CategoryID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->CategoryID }}</td>
                                    <td>{{ $category->Name }}</td>
                                    <td>{{ $category->Description }}</td>
                                    <td>{{ $category->Status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        {{-- <a href="{{ route('category.show', $category->CategoryID) }}" class="btn btn-success">Show</a> --}}
                                        <a href="{{ route('category.show', $category->CategoryID) }}" class="btn btn-success">Show</a>
                                        <a href="{{ route('category.edit', $category->CategoryID) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('category.destroy', $category->CategoryID) }}" method="POST" style="display:inline;">
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
