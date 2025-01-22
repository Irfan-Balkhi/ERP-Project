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
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('category.index') }}" method="GET" class="form-inline justify-center d-flex">
                                {{-- Search by Name --}}
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2"
                                    placeholder="Search by Name" style="background-color: rgb(240, 240, 240)">
                    
                                {{-- Search by ID --}}
                                <input type="number" name="CategoryID" value="{{ request('CategoryID') }}" class="form-control mr-2"
                                    placeholder="Search by ID" style="background-color: rgb(240, 240, 240)">
                    
                                {{-- Filter by Status --}}
                                <select name="status" class="form-control mr-2" style="background-color: rgb(240, 240, 240)">
                                    <option value="">All Status</option>
                                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                    
                                {{-- Filter Button --}}
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('category.index') }}" class="btn btn-secondary ml-2">Clear</a>
                            </form>
                        </div>
                    </div>                    

                    <div class="card" style="margin-top: 2rem">
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
                                            <form action="{{ route('category.destroy', $category->CategoryID) }}" method="POST" id="delete-form-{{ $category->CategoryID }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $category->CategoryID }}')" class="btn btn-danger">Delete</button>
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
    </div>
    </x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
