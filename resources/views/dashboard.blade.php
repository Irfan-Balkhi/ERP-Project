<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                     Welcome back, 
                     <span style="color: rgb(0, 140, 255);">
                        {{ auth()->user()->name }}! <br>
                     </span>
                    <p class="text-blue-500">
                        You have 
                        <span style="color: rgb(255, 183, 0);"> 
                            ( {{ auth()->user()->getRoleNames()->implode(', ') }} ) 
                        </span>
                        roles in the system.
                    </p>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
