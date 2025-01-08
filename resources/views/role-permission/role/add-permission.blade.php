<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Permission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Role : {{ $role->name}}
                </h2>
                <a href="{{ route('role.index') }}" class="btn btn-danger">Back</a>
            </div>
        </x-slot>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
            <div class="container mt-6">
                <div class="row">
                    <div class="col-md-12">

                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
    
                        <div class="card">
                            <div class="card-header">
                                <h4>Note: Create your roles below</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{url('role/' .$role->id. '/give-permissions' )}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        @error('permission')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <label for="name">Permissions:</label>
                                        <div class="row">
                                            @foreach ($permissions as $permission )
                                                <div class="col-md-2">
                                                    <label>
                                                        <input  type="checkbox" 
                                                                name="permission[]" 
                                                                value="{{ $permission->name }}" 
                                                                
                                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}

                                                        />
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>                                
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
