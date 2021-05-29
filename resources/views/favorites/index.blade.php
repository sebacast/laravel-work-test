<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('favorites.index') }} ">Favorites</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-right mb-4">
                <a href="{{ route('favorites.create') }}"
                    class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md">
                    Add Favorites
                </a>
            </p>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table class="table-auto" id="favorites-index">
                    <thead class="bg-blue-200">
                        <tr>
                            <th>ID</th>
                            <th>Name Name</th>
                            <th>Url</th>
                            <th>User</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($favorites as $favorite)
                            <tr class="hover:bg-gray-300 py-4 px-4">
                                <td class="border px-4 py-2">{{ $favorite->id }}</td>
                                <td class="border px-4 py-2">{{ $favorite->name }}</td>
                                <td class="border px-4 py-2">{{ $favorite->url }}</td>
                                <td class="border px-4 py-2">{{ $favorite->user->name }}</td>
                                @if (Auth::user()->id == $favorite->user_id)
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('favorites.show', $favorite) }} "
                                            class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">Show</a>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('favorites.edit', $favorite) }}"
                                            class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                                            Edit</a>
                                    </td>
                                    <td class="border px-4 py-2">

                                        <form action="{{ route('favorites.destroy', $favorite) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete"
                                                class="bg-red-500 text-white font-bold px-4 py-2 rounded-md">
                                        </form>


                                    </td>
                                @else
                                <td class="border px-4 py-2"></td>
                                <td class="border px-4 py-2"></td>
                                <td class="border px-4 py-2"></td>
                                @endif
                            </tr>
                        @empty
                            <tr class="hover:bg-gray-300 py-4 px-4">
                                <td class=" border px-4 py-2">No favorites found</td>
                                <td class=" border px-4 py-2">&nbsp;</td>
                                <td class=" border px-4 py-2">&nbsp;</td>
                                <td class=" border px-4 py-2">&nbsp;</td>
                                <td class=" border px-4 py-2">&nbsp;</td>

                            </tr>
                        @endforelse


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#favorites-index').DataTable();
        });

    </script>
</x-app-layout>
