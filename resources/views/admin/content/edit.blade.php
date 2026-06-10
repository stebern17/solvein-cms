@extends('layouts.dashboardLayout')

@section('title', 'Edit Content')

@section('content')
    <form method="POST" action="{{ route('admin.content.update') }}" enctype="multipart/form-data" class="space-y-6"
        id="contentForm" x-data="contentForm({
            imagePreviews: {
                image_1: @js($whatWeDo->image_1 ? asset('storage/' . $whatWeDo->image_1) : null),
                image_2: @js($whatWeDo->image_2 ? asset('storage/' . $whatWeDo->image_2) : null),
                image_3: @js($whatWeDo->image_3 ? asset('storage/' . $whatWeDo->image_3) : null),
            },
        })"
        data-existing-data="{{ json_encode([
            'hero_section' => $content->hero_section ?? null,
            'about_solvein' => $content->about_solvein ?? null,
            'description_1' => old('description_1')
                ? json_decode(old('description_1'), true)
                : $whatWeDo->description_1 ?? null,
            'description_2' => old('description_2')
                ? json_decode(old('description_2'), true)
                : $whatWeDo->description_2 ?? null,
            'description_3' => old('description_3')
                ? json_decode(old('description_3'), true)
                : $whatWeDo->description_3 ?? null,
        ]) }}">
        @csrf
        @method('PUT')

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Hero Section --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-lg font-bold text-slate-900">Hero Section</h3>
                <p class="mt-1 text-sm text-slate-500">Isi teks utama untuk bagian hero website.</p>
            </div>
            <div class="grid grid-cols-2 gap-6 p-6 items-center">
                <div>
                    <div id="editor-hero_section" class="min-h-[220px] bg-white"></div>
                    <input type="hidden" name="hero_section" id="hero_section">
                    @error('hero_section')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <img src="/images/hero_image.jpg" alt="Hero Image" class="w-full rounded-lg object-cover">

            </div>

        </div>

        {{-- About Solvein --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-lg font-bold text-slate-900">About Solvein</h3>
                <p class="mt-1 text-sm text-slate-500">Isi konten tentang Solvein.</p>
            </div>
            <div class="grid grid-cols-2 gap-6 p-6 items-center">
                <img src="images/logo_black.png" alt="Logo Solvein" class="w-full rounded-lg object-contain">
                <div>
                    <div id="editor-about_solvein" class="min-h-[220px] bg-white"></div>
                    <input type="hidden" name="about_solvein" id="about_solvein">
                    @error('about_solvein')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

        </div>

        {{-- What We Do --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-lg font-bold text-slate-900">What We Do</h3>
                <p class="mt-1 text-sm text-slate-500">Kelola tiga highlight layanan utama perusahaan.</p>
            </div>

            <div class="grid gap-6 p-6">
                @foreach ([1, 2, 3] as $number)
                    @php
                        $titleField = 'title_' . $number;
                        $imageField = 'image_' . $number;
                        $descriptionField = 'description_' . $number;
                    @endphp

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <div>
                                <h4 class="text-base font-bold text-slate-900">Item {{ $number }}</h4>
                                <p class="mt-1 text-sm text-slate-500">Title, image, dan rich text description.</p>
                            </div>
                        </div>

                        <div class="grid gap-6 lg:grid-cols-[1fr_260px]">
                            <div class="space-y-4">
                                <div>
                                    <label for="{{ $titleField }}"
                                        class="mb-2 block text-sm font-semibold text-slate-800">Title</label>
                                    <input id="{{ $titleField }}" name="{{ $titleField }}" type="text"
                                        value="{{ old($titleField, $whatWeDo->{$titleField}) }}"
                                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                        placeholder="Contoh: Strategy & Planning">

                                    @error($titleField)
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="mb-2 block text-sm font-semibold text-slate-800">Description</label>
                                    <div id="editor-{{ $descriptionField }}" class="min-h-[180px] bg-white"></div>
                                    <input type="hidden" name="{{ $descriptionField }}" id="{{ $descriptionField }}">

                                    @error($descriptionField)
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="{{ $imageField }}" class="mb-2 block text-sm font-semibold text-slate-800">
                                    Image
                                </label>
                                <input id="{{ $imageField }}" name="{{ $imageField }}" type="file"
                                    accept="image/jpeg,image/png,image/webp"
                                    @change="previewImage('{{ $imageField }}', $event)"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-slate-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-orange-600">

                                @error($imageField)
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <div class="mt-4 overflow-hidden rounded-lg border border-slate-200 bg-white">
                                    <template x-if="imagePreviews.{{ $imageField }}">
                                        <img :src="imagePreviews.{{ $imageField }}" alt="What We Do {{ $number }}"
                                            class="aspect-video w-full object-cover">
                                    </template>

                                    <div x-show="!imagePreviews.{{ $imageField }}"
                                        class="flex aspect-video items-center justify-center px-4 text-center text-sm text-slate-400">
                                        Image preview
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                Save Content
            </button>
        </div>
    </form>
@endsection

{{-- @push HARUS di luar @section --}}
@push('scripts')
    @vite(['resources/js/quill-content.js'])
@endpush
