<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Home
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <h2 class="text-center text-xl">Welcome to my Laravel Website!</h2>
            </div>
            <div class="flex">
                <x-icons.astronaut />
            
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#users-index').DataTable();
        });

    </script>
</x-app-layout>
