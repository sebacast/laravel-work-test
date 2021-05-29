<nav id="sidebar-menu" class="flex fixed w-100 h-full justify-between bg-red-500 text-gray-700 border-b border-gray-200">
    <div class="grid grid-cols-1 h-11">
        <a class="grid  grid-cols-3 py-3 hover:bg-red-700 h-10 border-red-900" href="{{route('home')}}">
            <x-menu.menu-icon-home />
            <p class="mx-2 col-span-2 text-white">
                Home
            </p>
        </a>
        <a class="grid  grid-cols-3 py-3 hover:bg-red-700 h-10 border-red-900" href="{{route('favorites.index')}}">
            <x-menu.menu-icon-favorites />
            <p class="mx-2 col-span-2 text-white">
                Favorites
            </p>
        </a>
        <a class="grid  grid-cols-3 py-3 hover:bg-red-700 h-10 border-red-900" href="{{route('users.index')}}">
            <x-menu.menu-icon-users />
            <p class="mx-2 col-span-2 text-white">
                Users
            </p>
        </a>
        
    </div>
    </nav>