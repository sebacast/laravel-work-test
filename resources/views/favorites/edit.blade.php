<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('favorites.index')}} ">Favorites</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('favorites.update', $favorite) }}" method="POST" class="max-w-md">
                    

                    <label class="block font-medium text-sm text-gray-700">Name</label>
                    <input class="form-input w-full rounded-md shadow-sm" type="text" name="name"
                        value="{{ $favorite->name }} ">

                        <label class="block font-medium text-sm text-gray-700">Url</label>
                    <input class="form-input w-full rounded-md shadow-sm" type="text" name="url"
                        value="{{ $favorite->url }} ">

                    <hr class="my-4">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="Edit" class="bg-blue-500 text-white font-bold px-4 py-2 rounded-md ">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
