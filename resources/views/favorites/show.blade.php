<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('favorites.index')}} ">Favorites</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">



                <label class="block font-medium text-sm text-gray-700">Name</label>
                <form action="{{ route('favorites.update-name', $favorite) }}" method="POST" class="grid grid-cols-4">
                    <input class="col-span-3 form-input w-full rounded-md shadow-sm" type="text" name="name"
                        value="{{ $favorite->name }} " required>
                    @csrf
                    @method('PUT')
                    <input type="submit" value="Change Name"
                        class="col-span-1 bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>

                <label class="block font-medium text-sm text-gray-700">Url</label>
                <form action="{{ route('favorites.update-url', $favorite) }}" method="POST" class="grid grid-cols-4">
                    @csrf
                    @method('PUT')
                    <input class="col-span-3 form-input w-full rounded-md shadow-sm" type="text" name="url"
                        value="{{ $favorite->url }} " required>
                    <input type="submit" value="Change Url"
                        class="col-span-1 bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>

               


            </div>
        </div>
    </div>
</x-app-layout>
