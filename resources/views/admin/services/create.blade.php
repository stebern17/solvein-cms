@extends('layouts.dashboardLayout')

@section('title', 'Create Service')

@section('content')
    <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data" class="space-y-6"
        x-data="serviceForm({
            points: @js(old('points', [''])),
        })" id="serviceForm"
        data-existing-data="{{ json_encode([
            'description' => old('description') ? json_decode(old('description'), true) : null,
        ]) }}">
        @csrf

        <div class="rounded-lg bg-white px-8 py-6 shadow-lg shadow-slate-900/5">
            <div class="flex flex-col gap-4 border-b border-slate-200 pb-5 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Create Service</h2>
                    <p class="mt-1 text-sm text-slate-500">Tambah layanan baru yang akan ditampilkan untuk Solvein.</p>
                </div>

                <a href="{{ route('admin.services.index') }}"
                    class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-orange-500 hover:text-orange-600">
                    Back
                </a>
            </div>

            <div class="mt-6 grid gap-6 lg:grid-cols-[1fr_320px]">
                <div class="space-y-6">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-semibold text-slate-800">Service Name</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                            placeholder="Contoh: Web Development">

                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-800">Description</label>
                        <div id="editor-description" class="min-h-[240px] rounded-b-lg bg-white"></div>
                        <input type="hidden" name="description" id="description">

                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="mb-3 flex items-center justify-between gap-4">
                            <div>
                                <h3 class="text-sm font-semibold text-slate-800">Service Points</h3>
                                <p class="mt-1 text-sm text-slate-500">Tambahkan poin singkat untuk highlight layanan.</p>
                            </div>

                            <button type="button" @click="addPoint()"
                                class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-600">
                                Add Point
                            </button>
                        </div>

                        <div class="space-y-3">
                            <template x-for="(point, index) in points" :key="index">
                                <div class="flex gap-3">
                                    <input type="text" name="points[]" x-model="points[index]"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                        placeholder="Contoh: Custom UI sesuai brand">

                                    <button type="button" @click="removePoint(index)"
                                        class="rounded-full border border-red-200 px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50">
                                        Remove
                                    </button>
                                </div>
                            </template>
                        </div>

                        @error('points')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @error('points.*')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <aside class="space-y-4">
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">
                        <label for="image" class="mb-2 block text-sm font-semibold text-slate-800">Service Image</label>
                        <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp"
                            @change="previewImage($event)"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-slate-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-orange-600">

                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="mt-4 overflow-hidden rounded-lg border border-slate-200 bg-white">
                            <template x-if="imagePreview">
                                <img :src="imagePreview" alt="Service preview" class="aspect-video w-full object-cover">
                            </template>

                            <div x-show="!imagePreview"
                                class="flex aspect-video items-center justify-center px-4 text-center text-sm text-slate-400">
                                Image preview
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                        Save Service
                    </button>
                </aside>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    @vite(['resources/js/quill-service.js'])
@endpush
