<x-app-layout>
    <div class="container mx-auto px-4 mt-12">

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories List') }}
        </h2>
    </x-slot>

        <div class="flex justify-center ">
            <div class="w-full max-w-4xl">
    
                <!-- Status Alert -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded shadow">
                        {{ session('status') }}
                    </div>
                @endif
    
                <!-- Card -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden mt-8 ">
                    <!-- Card Header -->
                    <div class="bg-indigo-600 px-6 py-3">
                        <h4 class="text-red-800 font-semibold text-lg">
                            Categories List
                            <a href="{{ url('category/create') }}" class="btn btn-primary float-right ">
                                Add Category
                            </a>
                        </h4>
                    </div>
    
                    <!-- Card Body -->
                    <div class="p-6">
                        <table class="table-auto w-full border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">CategoryID</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Description</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr class="border-t border-gray-300 hover:bg-gray-50">
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $category->CategoryID }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $category->Name }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $category->Description }}</td>
                                        <td class="px-4 py-2 text-sm text-gray-800">
                                            {{ $category->Status ? 'Active' : 'Inactive' }}
                                        </td>
                                        <td class="px-4 py-2 text-sm">
                                            <a href="{{ route('category.edit', $category->CategoryID) }}" class="bg-green-500 text-purple-800 py-1 px-3 rounded text-sm">
                                                Edit
                                            </a>
                                            <a href="{{ route('category.show', $category->CategoryID) }}" class="bg-blue-500 text-purple-800 py-1 px-3 rounded text-sm">
                                                Show
                                            </a>
                                            {{-- Uncomment if delete functionality is needed --}}
                                            {{-- 
                                            <form action="{{ route('category.destroy', $category->CategoryID) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                                                    Delete
                                                </button>
                                            </form>
                                            --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Uncomment for pagination --}}
                        {{-- {{$categories->links()}} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
