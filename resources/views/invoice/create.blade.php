<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoices List') }}
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Note: only for perviuos Record / External Invoice Number usage</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('invoice.store') }}" class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg">
                            @csrf
                        
                            <!-- Invoice Type -->
                            <div class="mb-4">
                                <label for="InvoiceType" class="block text-sm font-semibold text-gray-700 mb-2">Invoice Type</label>
                                <select name="InvoiceType" id="InvoiceType" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="internal">Internal</option>
                                    <option value="external">External</option>
                                </select>
                            </div>
                        
                            <!-- Invoice Number -->
                            <div class="mb-4">
                                <label for="InvoiceNumber" class="block text-sm font-semibold text-gray-700 mb-2">Invoice Number</label>
                                <input type="text" name="InvoiceNumber" id="InvoiceNumber" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Leave blank for internal" />
                            </div>
                        
                            <!-- Source -->
                            <div class="mb-4">
                                <label for="Source" class="block text-sm font-semibold text-gray-700 mb-2">Source</label>
                                <select name="Source" id="Source" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <option value="purchase">Purchase</option>
                                    <option value="sale">Sale</option>
                                    <option value="transaction">Transaction</option>
                                    <option value="manual">Manual</option>
                                </select>
                            </div>
                        
                            <!-- Amount -->
                            <div class="mb-4">
                                <label for="Amount" class="block text-sm font-semibold text-gray-700 mb-2">Amount</label>
                                <input type="number" step="0.01" name="Amount" id="Amount" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" required />
                            </div>
                        
                            <!-- Description -->
                            <div class="mb-4">
                                <label for="Description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                                <textarea name="Description" id="Description" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" rows="4"></textarea>
                            </div>
                        
                            <button type="submit" class="btn btn-primary ">
                                Create Invoice
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container mx-auto px-4 mt-12">

     --}}
    

        
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>