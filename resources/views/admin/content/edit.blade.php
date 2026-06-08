@extends('layouts.dashboardLayout')

@section('title', 'Edit Content')

@section('content')
    <form method="POST" action="{{ route('admin.content.update') }}" class="space-y-6" id="contentForm"
        data-existing-data="{{ json_encode([
            'hero_section' => $content->hero_section ?? null,
            'about_solvein' => $content->about_solvein ?? null,
        ]) }}">
        @csrf
        @method('PUT')

        @if (session('success'))
            <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
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
