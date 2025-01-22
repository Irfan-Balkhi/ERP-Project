<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Supplier List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Supplier List') }}
            <a href="{{ route('supplier.create') }}" class="btn btn-primary float-end">Add Supplier</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('supplier.index') }}" method="GET" class="form-inline justify-center d-flex">
                                <input type="text" name="SupplierID" value="{{ request('SupplierID') }}" class="form-control ml-2 mr-2"
                                    placeholder="Search by Supplier ID" style="background-color: rgb(240, 240, 240)">
                                <input type="text" name="CompanyName" value="{{ request('CompanyName') }}" class="form-control mr-2"
                                    placeholder="Search by Supplier Name" style="background-color: rgb(240, 240, 240)">
                                <input type="text" name="CompanyContactNumber" value="{{ request('CompanyContactNumber') }}" class="form-control mr-2"
                                    placeholder="Search by Contact Number" style="background-color: rgb(240, 240, 240)">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('supplier.index') }}" class="btn btn-secondary ml-2">Clear</a>
                            </form>
                        </div>
                    </div>
                    <div class="card" style="margin-top: 2rem">
                        <div class="card-header">
                            {{ $suppliers->links() }}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $key => $supplier)
                                    <tr>
                                        <td>{{ ($suppliers->currentPage() - 1) * $suppliers->perPage() + $key + 1 }}</td>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>{{ $supplier->CompanyName }}</td>
                                        <td>{{ $supplier->CompanyEmail }}</td>
                                        <td>{{ $supplier->CompanyContactNumber }}</td>
                                        <td>{{ $supplier->Address }}</td>
                                        <td>
                                            <a href="{{ route('supplier.show', $supplier->SupplierID) }}" class="btn btn-success">Show</a>
                                            <a href="{{ route('supplier.edit', $supplier->SupplierID) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('supplier.destroy', $supplier->SupplierID) }}" method="POST" id="delete-form-{{ $supplier->SupplierID }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $supplier->SupplierID }}')" class="btn btn-danger btn-sm">Delete</button>
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
