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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-body ">
                            <form action="{{ route('product.index') }}" method="GET" class="form-inline justify-center d-flex">
                                <input type="text" name="ProductID" value="{{ request('ProductID') }}" class="form-control ml-2 mr-2"
                                        placeholder="Search by Product ID" style="background-color: rgb(240, 240, 240)" >
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2"
                                    placeholder="Search by Name" style="background-color: rgb(240, 240, 240)">
                                <select name="CategoryID" class="form-control mr-2" style="background-color: rgb(240, 240, 240)">
                                    <option value="">All Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->CategoryID }}" {{ request('CategoryID') == $category->CategoryID ? 'selected' : '' }}>
                                            {{ $category->Name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('product.index') }}" class="btn btn-secondary ml-2">Clear</a>

                                {{-- Filter for Active/Trashed --}}
                                {{-- <select name="filter" class="form-control ml-2" onchange="this.form.submit()" style="background-color: rgb(240, 240, 240)">
                                    <option value="">All product</option>
                                    <option value="active" {{ request('filter') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="trashed" {{ request('filter') === 'trashed' ? 'selected' : '' }}>Trashed</option>
                                </select> --}}
                                
                            </form>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2rem">
                        {{-- llllllll --}}
                        {{-- <div>
                            <!-- Select search type -->
                            <label for="search_type">Search By:</label>
                            <select name="search_type" id="search_type" required>
                                <option value="name" {{ request('search_type') == 'name' ? 'selected' : '' }}>Name</option>
                                <option value="id" {{ request('search_type') == 'id' ? 'selected' : '' }}>ID</option>
                            </select>
                        </div>
                    
                        <div>
                            <!-- Search query -->
                            <label for="search_query">Search Query:</label>
                            <input type="text" name="search_query" id="search_query" value="{{ request('search_query') }}" required>
                        </div>
                    
                        <div>
                            <!-- Category filter -->
                            <label for="CategoryID">Category:</label>
                            <select name="CategoryID" id="CategoryID">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('CategoryID') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Search</button> --}}
                        {{-- م
                        م
                        م
                        م
                        م --}}
                        
                    {{-- </div> --}}
                        {{-- d
                        d
                        d
                        d
                        d
                        d --}}
                        <div class="card-header">
                            {{-- <h4>Note: Manage your products here</h4> --}}
                            <!-- Pagination links -->
                             {{ $products->links() }}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>ProductID</th> --}}
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <!-- Calculate the continuous number -->
                                        <td>{{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}</td>
               
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        {{-- <td>{{ $product->ProductID }}</td> --}}
                                        <td>{{ $product->ProductName }}</td>
                                        <td>{{ $product->category->Name }}</td> {{-- Assuming a relationship with the Category model --}}
                                        <td>{{ $product->Description }}</td>
                                        <td>
                                            <a href="{{ route('product.show', $product->ProductID) }}" class="btn btn-success">Show</a>
                                            <a href="{{ route('product.edit', $product->ProductID) }}" class="btn btn-warning">Edit</a>
                                            
                                            <form action="{{ route('product.destroy', $product->ProductID) }}" method="POST" id="delete-form-{{ $product->ProductID }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $product->ProductID }}')" class="btn btn-danger btn-sm">Delete</button>
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
    {{-- </div> --}}
    
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
