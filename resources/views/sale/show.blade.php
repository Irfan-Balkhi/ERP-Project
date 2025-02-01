<!-- filepath: resources/views/sale/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sale Details') }}
            <a href="{{ route('sale.index') }}" class="btn btn-secondary float-end">Back</a>
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sale Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <td>{{ $sale->InvoiceNumber }}</td>
                                    </tr>
                                    <tr>
                                        <th>Customer Name</th>
                                        <td>{{ $sale->CustomerName }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sale Date</th>
                                        <td>{{ $sale->SaleDate }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $sale->Description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Purchased Unit</th>
                                        <td>{{ $sale->PurchasedUnit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{ $sale->Quantity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price Per Unit</th>
                                        <td>{{ $sale->PricePerUnit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>{{ $sale->Total }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <h4 class="mt-4">Inventory Details</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Inventory ID</th>
                                        <td>{{ $sale->inventory->InventoryID ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Invoice Number (Inventory)</th>
                                        <td>{{ $sale->inventory->invoice->InvoiceNumber ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4 class="mt-4">Invoice Details</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <td>{{ $sale->inventory->invoice->InvoiceID ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <td>{{ $sale->inventory->invoice->InvoiceNumber ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Invoice Source</th>
                                        <td>{{ $sale->inventory->invoice->SourceType = "Sale" }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4 class="mt-4">Contract Details</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Contract ID</th>
                                        <td>{{ $sale->inventory->invoice->contract->CategoryID ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contract Number</th>
                                        <td>{{ $sale->inventory->invoice->contract->ContractNumber ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contract Start Date</th>
                                        <td>{{ $sale->inventory->invoice->contract->StartDate ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Contract End Date</th>
                                        <td>{{ $sale->inventory->invoice->contract->EndDate ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <h4 class="mt-4">Product Details</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Product Name</th>
                                        <td>{{ $sale->inventory->invoice->contract->product->ProductName ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Description</th>
                                        <td>{{ $sale->inventory->invoice->contract->product->Description ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product Category</th>
                                        <td>{{ $sale->inventory->invoice->contract->product->category->Name ?? 'N/A' }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="mt-4">
                                <a href="{{ route('sale.index') }}" class="btn btn-secondary">Back</a>
                                <a href="{{ route('sale.edit', $sale->SaleID) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('sale.destroy', $sale->SaleID) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>

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
