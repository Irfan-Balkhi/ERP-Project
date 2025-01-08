<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permissions Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Create Permission') }}
                </h2>
                <a href="{{ route('permission.index') }}" class="btn btn-danger">Back</a>
            </div>
        </x-slot>
        
        <div class="container mt-6">
            <div class="row">
                <div class="col-md-12">
                    {{-- @if (@session('status'))
                        <div class="alret alert-success">{{session('status')}}</div>
                    @endif --}}

                    <div class="card">
                        <div class="card-header">
                            <h4>Note: Create your permissions below</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('permission.store')}}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="">Permission Name</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>    
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
