<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('users.index')}} ">Users</a>
            
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">



                <label class="block font-medium text-sm text-gray-700">Name</label>
                <form action="{{ route('users.update-name', $user) }}" method="POST" class="grid grid-cols-4">
                    <input class="col-span-3 form-input w-full rounded-md shadow-sm" type="text" name="name"
                        value="{{ $user->name }} " required>
                    @csrf
                    @method('PUT')
                    <input type="submit" value="Change Name"
                        class="col-span-1 bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>

                <label class="block font-medium text-sm text-gray-700">Email</label>
                <form action="{{ route('users.update-email', $user) }}" method="POST" class="grid grid-cols-4">
                    @csrf
                    @method('PUT')
                    <input class="col-span-3 form-input w-full rounded-md shadow-sm" type="email" name="email"
                        value="{{ $user->email }} " required>
                    <input type="submit" value="Change Email"
                        class="col-span-1 bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>

                <label class="block font-medium text-sm text-gray-700">Birthday</label>
                <form action="{{ route('users.update-birthday', $user) }}" method="POST" class="grid grid-cols-4">
                    @csrf
                    @method('PUT')
                    <input class="col-span-3 form-input w-full rounded-md shadow-sm" type="date" name="birthday"
                        value="{{ $user->birthday }} " required>
                    <input type="submit" value="Change Birthday"
                        class="col-span-1 bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>

                <label class="block font-medium text-sm text-gray-700">Password</label>
                <form action="{{ route('users.update-password', $user) }}" method="POST" class="grid grid-cols-4">
                    @csrf
                    @method('PUT')
                    <input class="col-span-3 form-input w-full rounded-md shadow-sm" type="password" name="password"
                         required>
                    <input type="submit" value="Change Password"
                        class="col-span-1 bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>



            </div>
        </div>
    </div>
</x-app-layout>
