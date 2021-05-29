<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('users.index')}} ">Users</a>
        </h2>
    </x-slot>

    <button class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md " onclick="addFavoriteCreateForm()">Add New Form Box</button>
    <button class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md " onclick="removeLastFavoriteCreateForm()">Remove Last Form Box</button>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('users.store') }}" method="POST" class="max-w-5xl mx-auto">
                    @csrf
                    <input type="submit" value="Create Users" class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                    <div class="py-2 px-2" id="create-form-container">
                        <div class="py-3 px-3" id="create-form-child">
                            <h2>New User</h2>
                            <label class="block font-medium text-sm text-gray-700">Name</label>
                            <input class="form-input w-full rounded-md shadow-sm" type="text" name="name[]" required>

                            <label class="block font-medium text-sm text-gray-700">Birthday</label>
                            <input class="form-input w-full rounded-md shadow-sm" type="date" name="birthday[]" required>

                            <label class="block font-medium text-sm text-gray-700">Email</label>
                            <input class="form-input w-full rounded-md shadow-sm" type="email" name="email[]" required>
                            
                            <label class="block font-medium text-sm text-gray-700">Password</label>
                            <input class="form-input w-full rounded-md shadow-sm" type="password" name="password[]" required>

                            <label class="block font-medium text-sm text-gray-700">Password Confirmation</label>
                            <input class="form-input w-full rounded-md shadow-sm" type="password" name="password_confirmation[]" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
