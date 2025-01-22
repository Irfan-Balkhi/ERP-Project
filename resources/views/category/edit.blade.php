<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Category') }}
                <a href="{{ route('category.index') }}" class="btn btn-danger float-end">Back</a>
            </h2>
        </x-slot>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- this class is for centerlizing the contents --}}
            <div class="container mt-6">
                <div class="raw">
                    <div class="col-mid-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Note: Edit your category here</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('category.update', $category->CategoryID)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="Name" class="form-control" value="{{$category->Name}}"/>
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea type="text" name="Description" rows="3" class="form-control">{!! $category->Description !!}</textarea>
                                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                    <label for="Status">Status</label>
                                    <select name="Status" id="Status" class="form-select">
                                        <option value="1" {{ $category->Status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $category->Status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    @error('Status') <span class="text-danger">{{ $message }}</span> @enderror
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
    {{-- @include('page_style.footer') --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>