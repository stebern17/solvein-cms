@extends('layouts.dashboardLayout')

@section('title', 'Edit Profil')

@section('content')
    <div class="space-y-6">

        @if(session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
                class="rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Profile
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage your account information and password.
            </p>
        </div>

        {{-- Personal Information --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold">
                    Personal Information
                </h2>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5 p-6">

                @csrf
                @method('PUT')

                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Name
                    </label>

                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500">

                    @error('name')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-medium">
                        Email
                    </label>

                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2 focus:border-orange-500 focus:ring-orange-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button
                        class="rounded-lg bg-orange-500 px-5 py-2 font-medium text-white transition hover:bg-orange-600">
                        Save Changes
                    </button>
                </div>

            </form>

        </div>

        {{-- Password --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-6 py-4">
                <h2 class="text-lg font-semibold">
                    Change Password
                </h2>
            </div>

            <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5 p-6">

                @csrf
                @method('PUT')

                {{-- Current Password --}}
                <div x-data="{ show:false }">

                    <label class="mb-2 block text-sm font-medium">
                        Current Password
                    </label>

                    <div class="relative">

                        <input :type="show ? 'text' : 'password'" name="current_password"
                            class="w-full rounded-lg border border-slate-300 px-4 py-2 pr-11 focus:border-orange-500 focus:ring-orange-500">

                        <button type="button" @click="show=!show" class="absolute inset-y-0 right-3 flex items-center">

                            <x-heroicon-o-eye x-show="!show" class="h-5 w-5 text-slate-500" />

                            <x-heroicon-o-eye-slash x-show="show" class="h-5 w-5 text-slate-500" />

                        </button>

                    </div>

                </div>
                <div class="grid grid-cols-2 gap-4">
                    {{-- New Password --}}
                    <div x-data="{ show:false }">

                        <label class="mb-2 block text-sm font-medium">
                            New Password
                        </label>

                        <div class="relative">

                            <input :type="show ? 'text' : 'password'" name="password"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2 pr-11 focus:border-orange-500 focus:ring-orange-500">

                            <button type="button" @click="show=!show" class="absolute inset-y-0 right-3 flex items-center">

                                <x-heroicon-o-eye x-show="!show" class="h-5 w-5 text-slate-500" />

                                <x-heroicon-o-eye-slash x-show="show" class="h-5 w-5 text-slate-500" />

                            </button>

                        </div>

                    </div>

                    {{-- Confirm Password --}}
                    <div x-data="{ show:false }">

                        <label class="mb-2 block text-sm font-medium">
                            Confirm Password
                        </label>

                        <div class="relative">

                            <input :type="show ? 'text' : 'password'" name="password_confirmation"
                                class="w-full rounded-lg border border-slate-300 px-4 py-2 pr-11 focus:border-orange-500 focus:ring-orange-500">

                            <button type="button" @click="show=!show" class="absolute inset-y-0 right-3 flex items-center">

                                <x-heroicon-o-eye x-show="!show" class="h-5 w-5 text-slate-500" />

                                <x-heroicon-o-eye-slash x-show="show" class="h-5 w-5 text-slate-500" />

                            </button>

                        </div>

                    </div>

                </div>



                <div class="flex justify-end">

                    <button
                        class="rounded-lg bg-orange-500 px-5 py-2 font-medium text-white transition hover:bg-orange-600">

                        Update Password

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection