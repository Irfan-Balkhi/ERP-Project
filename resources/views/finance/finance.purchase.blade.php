<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases Overview</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Purchases Overview</h1>

        <!-- Filter Form -->
        <form action="{{ route('finance.purchases') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <input type="date" name="day" class="form-control" placeholder="Filter by Day">
                </div>
                <div class="col-md-3">
                    <input type="number" name="month" class="form-control" placeholder="Filter by Month (1-12)">
                </div>
                <div class="col-md-3">
                    <input type="number" name="year" class="form-control" placeholder="Filter by Year (e.g., 2024)">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </div>
        </form>

        <!-- Summary Card -->
        <div class="card mb-4">
            <div class="card-body">
                <h3>Total Purchases Amount: <span class="text-success">${{ number_format($totalAmount, 2) }}</span></h3>
            </div>
        </div>

        <!-- Purchases Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Purchase ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach ($purchases as $purchase)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase->id }}</td>
                        <td>${{ number_format($purchase->amount, 2) }}</td>
                        <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                        <td>{{ $purchase->description }}</td>
                    </tr>
                @endforeach
            </tbody> --}}
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
