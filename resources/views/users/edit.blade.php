<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('users.index')}} ">Users</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('users.update', $user) }}" method="POST" class="max-w-5xl mx-auto">
                    @csrf
                    @method('PUT')

                    <label class="block font-medium text-sm text-gray-700">Name</label>
                    <input class="form-input w-full rounded-md shadow-sm" type="text" name="name"
                        value="{{ $user->name }} " required>

                        <label class="block font-medium text-sm text-gray-700">Email</label>
                    <input class="form-input w-full rounded-md shadow-sm" type="email" name="email"
                        value="{{ $user->email }} " required>

                        <label class="block font-medium text-sm text-gray-700">Birthday</label>
                    <input class="form-input w-full rounded-md shadow-sm" type="date" name="birthday"
                        value="{{$user->birthday}} " required>

                        <label class="block font-medium text-sm text-gray-700">Password</label>
                    <input class="form-input w-full rounded-md shadow-sm" type="password" name="password"
                    required >
                    <hr class="my-4">
                    <input type="submit" value="Edit" class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
