
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> --}}

        <script src="https://kit.fontawesome.com/ab8c245882.js" crossorigin="anonymous"></script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome back,
                    <span style="color: rgb(0, 140, 255);">
                        {{ auth()->user()->name }}! <br>
                    </span>
                    <p class="text-blue-500">
                        You have
                        <span style="color: rgb(255, 183, 0);">
                            ( {{ auth()->user()->getRoleNames()->implode(', ') }} )
                        </span>
                        roles in the system.
                    </p>
                </div>
            </div>
        </div>
{{-- sdsdsdsds --}}
        {{-- <div class="w-full sm:w-1/4 p-4">
            <div class="flex items-center bg-blue-500 text-white p-4 rounded-lg shadow-md">
                <div class="p-3 bg-blue-700 rounded-full">
                     <i class="far fa-bars"></i> --}}
                  {{--  <i class="fas fa-bars"></i>

                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium">{{ __('menu.department') }}</p>
                    <i class="fa-solid fa-bars"></i>
                    <a href="{{ url('departments') }}" class="text-white text-sm underline">
                        {{ __('menu.management') }} <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div> --}}
        <!-- Departments -->
        {{-- <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-bars"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('menu.department') }}</span>
                    <span class="info-box-number">1,410</span>
                    <a href="{{ url('departments') }}" class="small-box-footer">{{ __('menu.management') }} <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div> --}}
        
        {{-- invoice table --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Recent Invoices</h3>
                        <a href="{{ route('invoice.index') }}" class="btn btn-primary">Add Invoice</a>
                    </div>
                    
                    <table class="table table-bordered mt-4 text-gray-800 dark:text-gray-200">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice Number</th>
                                <th>Type</th>
                                <th>Source</th>
                                <th>Date</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($newInvoices as $invoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $invoice->InvoiceNumber }}</td>
                                    <td>{{ ucfirst($invoice->InvoiceType) }}</td>
                                    <td>{{ ucfirst($invoice->InvoiceSource) }}</td>
                                    <td>{{ $invoice->Date }}</td>
                                    <td>{{ $invoice->TotalAmount ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No recent invoices found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
