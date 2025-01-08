<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Edit User') }}
                </h2>
                <a href="{{ route('user.index') }}" class="btn btn-danger">Back</a>
            </div>
        </x-slot>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
            <div class="container mt-6">
                <div class="row">
                    <div class="col-md-12">
                        {{-- @if (@session('status'))
                            <div class="alret alert-success">{{session('status')}}</div>
                        @endif --}}
    
                        <div class="card">
                            <div class="card-header">
                                <h4>Note: Edit the User Role below</h4>
                            </div>
                            <div class="card-body">
                                {{-- <form action="{{ route('user.update', $user->id)}}" method="POST"> --}}
                                <form action="{{ route('user.update', $user->id) }}" method="POST">

                                    @csrf
                                    @method('PUT')
    
                                    <div class="mb-3">
                                        <label for="">Name</label>
                                        <input type="text" name="name" value="{{ $user->name}}" class="form-control" />
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="">E-mail</label>
                                        <input type="text" name="email" value="{{ $user->email}}" class="form-control" readonly/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Password</label>
                                        <input type="text" name="password" class="form-control" />
                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                            <label for="">Roles</label>
                                            <select name="roles[]" class="form-control" multiple>
                                                <option value="">Select Role</option>
                                                @foreach ( $roles as $role )
                                                    <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                                        {{ $role }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
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
