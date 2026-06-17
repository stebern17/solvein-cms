@extends('layouts.dashboardLayout')

@section('title', 'Form Detail')

@section('content')
    <div class="space-y-6">
        <div
            class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white px-6 py-5 shadow-sm md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Submitted Form</p>
                <h3 class="mt-1 text-2xl font-medium text-slate-900">{{ $form->name }}</h3>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.form.index') }}"
                    class="rounded-full bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                    Back
                </a>
                <form action="{{ route('admin.form.destroy', $form) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus form ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-full bg-red-50 px-5 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-100">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="grid divide-y divide-slate-100 md:grid-cols-2 md:divide-x md:divide-y-0">
                <div class="space-y-1 px-6 py-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400">Nama</p>
                    <p class="text-base font-semibold text-slate-900">{{ $form->name }}</p>
                </div>
                <div class="space-y-1 px-6 py-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400">Telepon</p>
                    <p class="text-base font-semibold text-slate-900">{{ $form->phone }}</p>
                </div>
            </div>

            <div class="border-t border-slate-100 px-6 py-5">
                <p class="text-xs font-bold uppercase tracking-wide text-slate-400">Subject</p>
                <p class="mt-1 text-base font-semibold text-slate-900">{{ $form->subject }}</p>
            </div>

            <div class="border-t border-slate-100 px-6 py-5">
                <p class="text-xs font-bold uppercase tracking-wide text-slate-400">Pesan</p>
                <p class="mt-3 whitespace-pre-line text-sm leading-7 text-slate-700">{{ $form->message }}</p>
            </div>

            <div class="border-t border-slate-100 bg-slate-50 px-6 py-4 text-sm text-slate-500">
                Dibuat pada {{ $form->created_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                @if ($form->updated_at && $form->updated_at->ne($form->created_at))
                    <span class="mx-2 text-slate-300">/</span>
                    Diperbarui pada {{ $form->updated_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                @endif
            </div>
        </section>
    </div>
@endsection
