@extends('layouts.dashboardLayout')

@section('title', 'Email Form Detail')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-white px-6 py-5 shadow-sm md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Submitted Email</p>
                <h3 class="mt-1 break-all text-2xl font-bold text-slate-900">{{ $emailForm->email }}</h3>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.form.index') }}"
                    class="rounded-full bg-slate-100 px-5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                    Back
                </a>
                <form action="{{ route('admin.form.destroy_email', $emailForm) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus email ini?')">
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
            <div class="px-6 py-5">
                <p class="text-xs font-bold uppercase tracking-wide text-slate-400">Email</p>
                <p class="mt-1 break-all text-lg font-semibold text-slate-900">{{ $emailForm->email }}</p>
            </div>

            <div class="border-t border-slate-100 bg-slate-50 px-6 py-4 text-sm text-slate-500">
                Dibuat pada {{ $emailForm->created_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                @if ($emailForm->updated_at && $emailForm->updated_at->ne($emailForm->created_at))
                    <span class="mx-2 text-slate-300">/</span>
                    Diperbarui pada {{ $emailForm->updated_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                @endif
            </div>
        </section>
    </div>
@endsection
