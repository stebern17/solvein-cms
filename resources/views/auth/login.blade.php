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
                <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-white border-gray-500 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-white text-sm font-bold mb-2">Password</label>
                <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-white border-gray-500  leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="bg-orange-500 hover:bg-orange-700 transition-colors duration-300 text-white font-bold py-2 px-4 w-full rounded-lg focus:outline-none focus:shadow-outline">
                Login
            </button>
        </form>
    </div>
    
</body>
</html>