@extends('layouts.dashboardLayout')

@section('title', 'Edit Client')

@section('content')
    <form method="POST" action="{{ route('admin.clients.update', $client) }}" enctype="multipart/form-data" class="space-y-6">

        @csrf
        @method('PUT')
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    <p class="font-semibold">Ada input yang belum sesuai.</p>
                    <ul class="mt-2 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Client Detail</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Ganti nama client atau upload logo baru.
                    </p>
                </div>

                <a href="{{ route('admin.clients.index') }}"
                    class="rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-950 hover:text-slate-950">
                    Back
                </a>
            </div>

            <div class="grid gap-6 p-6 lg:grid-cols-[1fr_320px]">
                <div class="space-y-5">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-800">
                            Client Name
                        </label>

                        <input id="name" name="name" type="text" value="{{ old('name', $client->name) }}"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                            placeholder="Contoh: PT Example Indonesia" required>

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="mb-2 block text-sm font-semibold text-slate-800">
                            Client Logo / Icon
                        </label>

                        <input id="image" name="image" type="file"
                            accept="image/jpeg,image/png,image/webp,image/svg+xml"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-slate-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-orange-600">

                        <p class="mt-2 text-xs text-slate-500">
                            Kosongkan jika tidak ingin mengganti logo.
                        </p>

                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <p class="mb-2 text-sm font-semibold text-slate-800">
                        Current Logo
                    </p>

                    <div class="overflow-hidden rounded-xl border border-slate-200 bg-slate-50 p-6">
                        @if ($client->image)
                            <div class="flex aspect-video items-center justify-center rounded-lg bg-white p-6">
                                <img src="{{ asset('storage/' . $client->image) }}" alt="{{ $client->name }}"
                                    class="max-h-28 max-w-full object-contain">
                            </div>
                        @else
                            <div
                                class="flex aspect-video items-center justify-center rounded-lg bg-white px-4 text-center text-sm text-slate-400">
                                No image
                            </div>
                        @endif

                        <div class="mt-4">
                            <h4 class="text-sm font-bold text-slate-900">
                                {{ $client->name }}
                            </h4>
                            <p class="mt-1 break-all text-xs text-slate-400">
                                {{ $client->image }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                Update Client
            </button>
        </div>
    </form>
@endsection
