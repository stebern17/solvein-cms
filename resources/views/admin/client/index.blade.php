@extends('layouts.dashboardLayout')

@section('title', 'Clients')

@section('content')
    <div class="space-y-6">
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm px-6 py-4">
            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
                    class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            <div class="border-b border-slate-200 flex justify-between items-center px-6 py-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Client List</h3>
                    <p class="text-sm text-slate-500">
                        Total client: {{ $clients->count() }}
                    </p>
                </div>
                <a href="{{ route('admin.clients.create') }}"
                    class="rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                    Add Clients
                </a>

            </div>

            <div class="p-6">
                @if ($clients->isEmpty())
                    <div class="rounded-xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center">
                        <p class="text-sm font-medium text-slate-600">Belum ada client.</p>
                        <a href="{{ route('admin.clients.create') }}"
                            class="mt-4 inline-flex rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                            Tambah Client
                        </a>
                    </div>
                @else
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($clients as $client)
                            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
                                <div class="flex aspect-video items-center justify-center rounded-lg bg-slate-50 p-5">
                                    <img src="{{ asset('storage/' . $client->image) }}" alt="{{ $client->name }}"
                                        class="max-h-20 max-w-full object-contain">
                                </div>

                                <div class="mt-4 flex items-center justify-between gap-3">
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900">
                                            {{ $client->name }}
                                        </h4>
                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $client->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.clients.edit', $client) }}"
                                            class="rounded-full bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.clients.destroy', $client) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus client ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="rounded-full bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100 cursor-pointer">
                                                Delete
                                            </button>
                                        </form>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
