<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contract List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contract List') }}
            <a href="{{ route('contract.create') }}" class="btn btn-primary float-end">Add Contract</a>
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
                            <form action="{{ route('contract.index') }}" method="GET" class="form-inline justify-center d-flex">
                                <input type="text" name="ContractID" value="{{ request('ContractID') }}" class="form-control ml-2 mr-2"
                                    placeholder="Search by Contract ID" style="background-color: rgb(240, 240, 240)">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control mr-2"
                                    placeholder="Search by Name" style="background-color: rgb(240, 240, 240)">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('contract.index') }}" class="btn btn-secondary ml-2">Clear</a>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">
                            {{-- {{ $contracts->links() }} --}}
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Contract ID</th>
                                        <th>Supplier Name</th>
                                        <th>Total Value</th>
                                        <th>Total Quantity</th>
                                        <th>Contract Attachment</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contracts as $key => $contract)
                                    <tr>
                                        <td>{{ ($contracts->currentPage() - 1) * $contracts->perPage() + $key + 1 }}</td>
                                        <td>{{ $contract->ContractID }}</td>
                                        <td>{{ $contract->supplier->CompanyName ?? 'N/A' }}</td> <!-- Safeguard for missing supplier -->
                                        <td>{{ $contract->TotalValue }}</td>
                                        <td>{{ $contract->TotalQuantity }}</td>
                                        <td>{{ $contract->ContractAttachment }}</td>
                                        <td>{{ $contract->StartDate }}</td>
                                        <td>{{ $contract->EndDate }}</td>


                                         <td>
                                            <a href="{{ route('contract.show', $contract->ContractID) }}" class="btn btn-success">Show</a>
                                            {{--<a href="{{ route('contract.edit', $contract->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('contract.destroy', $contract->id) }}" method="POST" id="delete-form-{{ $contract->id }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td> --}}
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
