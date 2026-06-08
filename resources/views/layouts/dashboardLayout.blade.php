<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Solvein CMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-200 text-slate-900 mb-6">
    <header x-data="{ profileOpen: false }" class="sticky top-0 z-50">
        {{-- Top Header --}}
        <div class="bg-slate-950">
            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6">
                <a href="/admin/dashboard" class="inline-flex items-center">
                    <img src="/logos/logo_white.png" alt="Solvein Logo" class="h-11 w-auto">
                </a>

                <x-profile-dropdown />
            </div>

        </div>
        {{-- Glass Navigation --}}
        <nav
            class="border-b border-white/30 bg-white/45 shadow-lg shadow-slate-900/5 backdrop-blur-2xl backdrop-saturate-150">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-6">
                <div
                    class="flex items-center gap-2 rounded-full border border-white/40 bg-white/30 p-1 shadow-inner shadow-white/20 backdrop-blur-xl">
                    <a href="/dashboard"
                        class="rounded-full px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-white/60 hover:text-orange-600">
                        Dashboard
                    </a>

                    <a href="/posts"
                        class="rounded-full px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-white/60 hover:text-orange-600">
                        Posts
                    </a>

                    <a href="/services"
                        class="rounded-full px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-white/60 hover:text-orange-600">
                        Services
                    </a>

                    <a href="/content"
                        class="rounded-full px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-white/60 hover:text-orange-600">
                        Content
                    </a>
                    <a href="/client"
                        class="rounded-full px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-white/60 hover:text-orange-600">
                        Client
                    </a>
                    <a href="/forms"
                        class="rounded-full px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-white/60 hover:text-orange-600">
                        Forms
                    </a>
                    <a href="/users"
                        class="rounded-full px-5 py-2 text-sm font-medium text-slate-700 transition hover:bg-white/60 hover:text-orange-600">
                        Users
                    </a>

                </div>
            </div>
        </nav>
    </header>
    <section class="container mt-8 flex flex-col gap-6">
        <div
            class="bg-white w-full rounded-lg px-8 py-4 flex items-center justify-between shadow-lg shadow-slate-900/5">
            <h2
                class="text-3xl font-bold text-slate-800 text-shadow-gray-400 text-shadow-2xs uppercase tracking-widest">
                @yield('title', 'Admin Dashboard')
            </h2>
            <p>
                Welcome, {{ auth()->user()->name ?? 'Admin' }}
            </p>
        </div>
        @yield('content')
    </section>
    @stack('scripts')
</body>

</html>
