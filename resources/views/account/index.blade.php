<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transaction List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Accounts List') }}
                </h2>
                @include('transaction.nav-links')
                <a href="{{ route('account.create') }}" class="btn btn-primary float-end">Add Account</a>
            </div>

        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container mt-6">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $key => $account)
                                    <tr>
                                        <td>{{ ($accounts->currentPage() - 1) * $accounts->perPage() + $key + 1 }}</td>
                                        <td>{{ $account->name }}</td>
                                        <td>{{ ucfirst($account->type) }}</td>
                                        <td>${{ number_format($account->balance, 2) }}</td>
                                        <td>
                                            <a href="{{ route('account.edit', $account->accountID) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('account.destroy', $account->accountID) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $accounts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(event, formId) {
            event.preventDefault();
            if (confirm("Are you sure you want to delete this transaction?")) {
                document.getElementById(formId).submit();
            }
        }
    </script>
</body>

</html>
