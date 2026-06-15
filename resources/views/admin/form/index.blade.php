@extends('layouts.dashboardLayout')

@section('title', 'Forms')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition
                class="rounded-lg border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid gap-6 xl:grid-cols-3">
            <section class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm col-span-2">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h3 class="text-xl font-bold text-slate-900">Forms</h3>
                    <p class="text-sm text-slate-500">Total data: {{ $forms->total() }}</p>
                </div>

                @if ($forms->isEmpty())
                    <div class="px-6 py-12 text-center">
                        <p class="text-sm font-medium text-slate-500">Belum ada data form.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="px-5 py-3">Nama</th>
                                    <th class="px-5 py-3">Telepon</th>
                                    <th class="px-5 py-3">Subject</th>
                                    <th class="px-5 py-3">Pesan</th>
                                    <th class="px-5 py-3">Dibuat</th>
                                    <th class="px-5 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach ($forms as $form)
                                    <tr class="align-top transition hover:bg-slate-50">
                                        <td class="px-5 py-4 font-semibold text-slate-900 whitespace-nowrap">
                                            {{ $form->name }}</td>
                                        <td class="px-5 py-4 text-slate-600">{{ $form->phone }}</td>
                                        <td class="px-5 py-4 text-slate-700">{{ $form->subject }}</td>
                                        <td class="max-w-xs px-5 py-4 text-slate-600">
                                            {{ Str::limit($form->message, 120) }}
                                        </td>
                                        <td class="whitespace-nowrap px-5 py-4 text-slate-500">
                                            {{ $form->created_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.form.show', $form) }}"
                                                    class="rounded-full bg-slate-100 px-4 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                                                    Detail
                                                </a>
                                                <form action="{{ route('admin.form.destroy', $form) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus form ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="rounded-full bg-red-50 px-4 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t border-slate-200 px-6 py-4">
                        {{ $forms->appends(request()->except('forms_page'))->links() }}
                    </div>
                @endif
            </section>

            <section class="self-start h-fit overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h3 class="text-lg font-bold text-slate-900">Email Forms</h3>
                    <p class="text-sm text-slate-500">Total data: {{ $emailForms->total() }}</p>
                </div>

                @if ($emailForms->isEmpty())
                    <div class="px-5 py-10 text-center">
                        <p class="text-sm font-medium text-slate-500">Belum ada data email.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <thead class="bg-slate-50 text-left text-xs font-bold uppercase tracking-wide text-slate-500">
                                <tr>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Waktu</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach ($emailForms as $emailForm)
                                    <tr class="whitespace-nowrap align-top transition hover:bg-slate-50">
                                        <td class="break-all px-4 py-4 font-semibold text-slate-900">
                                            {{ $emailForm->email }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-4 text-slate-500">
                                            {{ $emailForm->created_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                            WIB
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.form.show_email', $emailForm) }}"
                                                    class="rounded-full bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700 transition hover:bg-slate-200">
                                                    Detail
                                                </a>
                                                <form action="{{ route('admin.form.destroy_email', $emailForm) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus email ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="rounded-full bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="border-t border-slate-200 px-5 py-4">
                        {{ $emailForms->appends(request()->except('email_forms_page'))->links() }}
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
