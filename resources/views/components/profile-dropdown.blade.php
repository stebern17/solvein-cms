<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
        class="inline-flex items-center justify-center rounded-full bg-white/10 p-2 text-white transition hover:bg-white/20">
        <x-heroicon-o-user-circle class="h-9 w-9" />
    </button>

    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md bg-white shadow-lg z-50">
        <div>
            <p class="block px-4 py-2 text-md text-gray-700 font-medium">Hello, {{ auth()->user()->name ?? 'Admin' }}</p>
            <a href="/admin/profile"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Profile</a>
            <a href="/admin/settings"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Settings</a>
            <form method="POST" action="/logout">
                @csrf
                <button type="submit"
                    class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Logout</button>
            </form>
        </div>
    </div>
</div>
