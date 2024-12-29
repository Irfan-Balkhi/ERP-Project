<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Finance Dashboard') }}
                {{-- <a href="{{ route('inventory.create') }}" class="btn btn-primary float-end">Add Inventory</a> --}}
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
            <div class="container row row-cols-1 row-cols-md-2 g-4" style="margin-top: 2rem">
                <div class="col">
                  <div class="card border-success" style="max-width: 35rem;">
                    <div class="card-body text-center">
                      <h5 class="card-title text-bg-success">Purchases</h5>
                      <p class="card-text">Total Purchases: ${{ number_format($totalPurchases, 2) }}</p>
                      <a href="#" class="btn btn-success">Details</a>
                      {{-- <a href="{{ route('finance.purchases') }}">Details</a> --}}
                    </div>
                  </div>
                </div>
                <div class="col">
                    <div class="card border-info" style="max-width: 35rem;">
                      <div class="card-body text-center">
                        <h5 class="card-title text-bg-info">Sales </h5>
                        <p class="card-text">Total Sales: ${{ number_format($totalSales, 2)}}</p>
                        <a href="#" class="btn btn-info">Details</a>
                    </div>
                    </div>
                  </div>
                <div class="col">
                  <div class="card border-warning" style="max-width: 35rem;">
                    <div class="card-body text-center">
                      <h5 class="card-title text-bg-warning">Transactions</h5>
                      <p class="card-text">Total Transactions: ${{ number_format($totalTransactions, 2)}}</p>
                      <a href="#" class="btn btn-warning">Details</a>
                    </div>
                  </div>
                </div>
                <div class="col">
                    <div class="card border-danger" style="max-width: 35rem;">
                      <div class="card-body text-center">
                        <h5 class="card-title text-bg-danger">Expenses</h5>
                        <p class="card-text">Total Expenses: ${{ number_format($totalExpenses, 2)}}</p>
                        <a href="#" class="btn btn-danger">Details</a>
                      </div>
                    </div>
                  </div>
              </div>
            {{-- <div>
                <h1>Finance Overview</h1>
                <div class="card">
                    <h2>Total Purchases: {{ $finance->TotalPurchases }}</h2>
                </div>
                <div class="card">
                    <h2>Total Sales: {{ $finance->TotalSales }}</h2>
                </div>
                <div class="card">
                    <h2>Additional Expenses: {{ $finance->AdditionalExpenses }}</h2>
                </div>
                <div class="card">
                    <h2>Profit or Loss: {{ $finance->ProfitOrLoss }}</h2>
                </div>
            </div> --}}
            
        </div>
        
    </x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
