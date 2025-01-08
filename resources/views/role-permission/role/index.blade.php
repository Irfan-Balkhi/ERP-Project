<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roles Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Roles List') }}
                </h2>
                @include('role-permission.nav-links')
                
                <a href="{{ route('role.create') }}" class="btn btn-primary">Add Roles</a>
            </div>
        </x-slot>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
            <div class="container mt-6">
                <div class="row">
                    <div class="col-md-12">
                        
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
    
                        <div class="card mt-3">
                            <div class="card-header">
                                <h4>Note: Manage your application roles below</h4>
                            </div>
                            <div class="card-body">
                                
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    {{-- <a href="{{ route('permission.show', $permission->id) }}" class="btn btn-success btn-sm">Show</a> --}}
                                                    <a href="{{url('role/' .$role->id. '/give-permissions' )}}" class="btn btn-info btn-sm">
                                                        Add / Edit Role Permission
                                                    </a>
                                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST" id="delete-form-{{ $role->id }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
    
                                                        <button type="button" onclick="confirmDelete(event, 'delete-form-{{ $role->id }}')" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
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
