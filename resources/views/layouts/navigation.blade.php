<nav x-data="{ open: false, dropdown: null }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Main Navbar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
             <!-- Logo -->
             <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a>
            </div>
            {{--uses for dropdown leaving @mouseleave="dropdown = null" --}}
            <!-- Primary Tabs --> 
            <div class="flex space-x-8">
                <button @mouseenter="dropdown = 'dashboard'" @click="dropdown = dropdown === 'dashboard' ? null : 'dashboard'" class="font-medium text-gray-800 dark:text-gray-200" >
                    Dashboard
                </button>
                <button @mouseenter="dropdown = 'products'" @click="dropdown = dropdown === 'products' ? null : 'products'" class="font-medium text-gray-800 dark:text-gray-200">
                    Products & Inventory
                </button>
                <button @mouseenter="dropdown = 'sales'" @click="dropdown = dropdown === 'sales' ? null : 'sales'" class="font-medium text-gray-800 dark:text-gray-200">
                    Sales & Transactions
                </button>
                <button @mouseenter="dropdown = 'management'" @click="dropdown = dropdown === 'management' ? null : 'management'" class="font-medium text-gray-800 dark:text-gray-200">
                    Management & Reports
                </button>
            </div>
           

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form> --}}
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Dropdown Row -->
<div x-show="dropdown" class="sm:flex sm:items-center bg-gray-100 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div x-show="dropdown === 'dashboard'" class="flex space-x-8">
            <a href="{{ route('dashboard') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Dashboard</a>
        </div>
        <div x-show="dropdown === 'products'" class="flex space-x-8">
            <a href="{{ route('product.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Products</a>
    
            @can('category index')
                <a href="{{ route('category.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Categories</a>
            @endcan
            
            <a href="{{ route('inventory.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Inventory</a>

            <a href="{{ route('supplier.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Supplier</a>

        </div>
        <div x-show="dropdown === 'sales'" class="flex space-x-8">
            <a href="{{ route('purchase.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Purchase</a>
            <a href="{{ route('sale.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Sales</a>
            <a href="{{ route('transaction.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Transaction</a>
            <a href="{{ route('invoice.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Invoice</a>
        </div>
        <div x-show="dropdown === 'management'" class="flex space-x-8">
            <a href="{{ route('finance.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Financials</a>
            <a href="{{ route('expense.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Expenses</a>
            
             @can('permission index') {{-- Permission for the roles that can or can not use a function using blade --}}
                <a href="{{ route('permission.index') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">HR</a>
            @endcan

            <a href="{{ route('dashboard') }}" class="text-gray-800 dark:text-gray-200 hover:text-blue-500">Reports</a>
        </div>
    </div>
</div>

</nav>
