@extends('layouts.dashboardLayout')

@section('title', 'Services')

@section('content')
    <div class="bg-white w-full rounded-lg px-8 py-4 shadow-lg shadow-slate-900/5">
        <h2 class="text-2xl font-bold text-slate-800 mb-4">Manage Services</h2>
        <p class="text-sm text-slate-500 mb-6">Add, edit, or delete services offered by Solvein.</p>

        <a href="{{ route('admin.services.create') }}"
            class="inline-block mb-4 rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
            Add New Service
        </a>

        @if ($services->isEmpty())
            <p class="text-sm text-slate-500">No services found. Start by adding a new service.</p>
        @else
            <div class="space-y-4">
                @foreach ($services as $service)
                    @php
                        $description = $service->description;

                        if (is_array($description)) {
                            $description = $description['text'] ?? strip_tags($description['html'] ?? '');
                        }
                    @endphp

                    <div
                        class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900">{{ $service->name }}</h3>
                            <p class="mt-1 text-sm text-slate-500">
                                {{ Str::limit($description ?: 'No description yet.', 100) }}
                            </p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.services.edit', $service) }}"
                                class="rounded-full bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">
                                Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this service?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="rounded-full bg-red-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
