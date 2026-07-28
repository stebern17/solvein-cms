<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
        class="inline-flex items-center justify-center rounded-full cursor-pointer bg-white/10 p-2 text-white transition hover:bg-white/20">
        <x-heroicon-o-user-circle class="h-9 w-9" />
    </button>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-2 scale-95" @click.outside="open = false"
        class="absolute right-0 z-50 mt-3 w-56 origin-top-right overflow-hidden rounded-2xl border border-white/20 bg-white/90 p-2 shadow-xl shadow-slate-900/10 backdrop-blur-xl"
        style="display: none;"">
        <div>
            <p class=" block px-4 py-2 text-md text-gray-700 font-medium">Hello, {{ auth()->user()->name ?? 'Admin' }}
        </p>
        <a href="/admin/profile"
            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-orange-600 transition duration-300">Profile</a>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit"
                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-orange-600 transition duration-300 cursor-pointer">Logout</button>
        </form>
    </div>
</div>
</div>