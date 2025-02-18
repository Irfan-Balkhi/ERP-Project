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
                    {{ __('Add Account') }}
                </h2>
                @include('transaction.nav-links')
                <a href="{{ route('account.index') }}" class="btn btn-danger float-end">Back</a>
            </div>

        </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="container mt-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('account.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control" required>
                                    <option value="sarrafi">Sarrafi</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Balance</label>
                                <input type="number" name="balance" class="form-control" step="0.01" min="0"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('account.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
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
