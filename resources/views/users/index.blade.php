<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('users.index')}} ">Users</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-right mb-4">
                <a href="{{ route('users.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
                    Add Users
                </a>
            </p>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table class="table-auto" id="users-index">
                    <thead class="bg-blue-200">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-300 py-4 px-4">
                                <td class="border px-4 py-2">{{ $user->id }}</td>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                @php
                                    $time = strtotime($user->birthday);
                                    $birthday = date('jS F, Y',$time);
                                @endphp
                                <td class="border px-4 py-2"> {{$birthday}} </td>
                                <td class="border px-4 py-2"><a href="{{ route('users.edit', $user) }} "
                                        class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">Edit</a> </td>
                                <td class="border px-4 py-2"> <a href="{{ route('users.show', $user) }}"
                                        class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">Show</a> </td>

                                <td class="border px-4 py-2">
                                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Delete"
                                            class="bg-red-500 text-white font-bold px-4 py-2 rounded-md">
                                    </form>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#users-index').DataTable();
        });

    </script>
</x-app-layout>
