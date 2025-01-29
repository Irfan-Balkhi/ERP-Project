<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0"></script> --}}
            {{-- use for Invoice direction from user --}}
            {{-- <script>
                function showInvoiceOptions() {
                    Swal.fire({
                        title: 'Where do you want to go?',
                        icon: 'question',
                        showCancelButton: true,
                        showDenyButton: true,
                        showConfirmButton: true,
                        confirmButtonText: 'Purchase',
                        denyButtonText: 'Sale',
                        cancelButtonText: 'Transaction',
                        reverseButtons: true // Adjust button order
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to Contract page
                            // window.location.href = "{{ route('contract.list') }}";
                            // window.location.href = "{{ route('invoice.contract') }}";
                        } else if (result.isDenied) {
                            // Redirect to Sale page
                            window.location.href = "{{ route('invoice.sale') }}";
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            // Redirect to Transaction page
                            window.location.href = "{{ route('invoice.transaction') }}";
                        }
                    });
                }
            </script> --}}


            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @include('components.sweetalert')
    </body>
</html>
