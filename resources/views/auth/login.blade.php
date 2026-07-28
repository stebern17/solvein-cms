<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login CMS Solvein</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
@livewireScripts

<body class="min-h-screen bg-slate-100 flex items-center justify-center">
    <div class="bg-slate-900 rounded-lg flex flex-col items-center justify-center px-16 py-8 gap-4 shadow-2xl">
        <img src="/logos/logo_white.png" alt="logo solvein" class="w-64">
        <form action="{{ route('login') }}" method="POST" class="w-72">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-white text-sm font-bold mb-2">Email</label>
                <input type="email" id="email" name="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-white border-gray-500 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4" x-data="{ showPassword: false }">
                <label for="password" class="block text-white text-sm font-bold mb-2">
                    Password
                </label>

                <div class="relative">
                    <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                        class="w-full rounded border border-gray-500 bg-transparent py-2 pl-3 pr-10 text-white">

                    <button type="button" @click="showPassword = !showPassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white">

                        <template x-if="!showPassword">
                            <x-heroicon-o-eye class="w-5 h-5" />
                        </template>

                        <template x-if="showPassword">
                            <x-heroicon-o-eye-slash class="w-5 h-5" />
                        </template>

                    </button>
                </div>
            </div>
            {{-- remember me --}}
            <div class="mb-4">
                <label class="inline-flex items-center text-white cursor-pointer">
                    <input type="checkbox" name="remember" value="1"
                        class="rounded border-gray-500 text-orange-500 focus:ring-orange-500">

                    <span class="ml-2">Remember Me</span>
                </label>
            </div>
            <button type="submit"
                class="bg-orange-500 cursor-pointer hover:bg-orange-700 transition-colors duration-300 text-white font-bold py-2 px-4 w-full rounded-lg focus:outline-none focus:shadow-outline">
                Login
            </button>
        </form>
    </div>

</body>

</html>