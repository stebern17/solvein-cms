@extends('layouts.dashboardLayout')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">

        {{-- Statistics --}}
        <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">

            <x-stats-card title="Services" :value="$totalServices" color="orange">

                <x-slot:icon>
                    <x-heroicon-o-briefcase class="w-7 h-7" />
                </x-slot:icon>

            </x-stats-card>

            <x-stats-card title="Clients" :value="$totalClients" color="blue">

                <x-slot:icon>
                    <x-heroicon-o-building-office-2 class="w-7 h-7" />
                </x-slot:icon>

            </x-stats-card>

            <x-stats-card title="Contact Forms" :value="$totalForms" color="green">

                <x-slot:icon>
                    <x-heroicon-o-chat-bubble-left-right class="w-7 h-7" />
                </x-slot:icon>

            </x-stats-card>

            <x-stats-card title="Email Subscribers" :value="$totalEmailForms" color="purple">

                <x-slot:icon>
                    <x-heroicon-o-envelope class="w-7 h-7" />
                </x-slot:icon>

            </x-stats-card>

        </div>

        {{-- Recent Data --}}
        <div class="grid gap-6 xl:grid-cols-2">

            {{-- Recent Contact Forms --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                    <h2 class="font-semibold text-slate-900">
                        Recent Contact Forms
                    </h2>

                    <a href="{{ route('admin.form.index') }}" class="text-sm text-orange-500 hover:text-orange-600">
                        View All
                    </a>
                </div>

                <div class="divide-y divide-slate-100">

                    @forelse($recentForms as $form)

                        <div class="flex items-start justify-between px-6 py-4">

                            <div>

                                <h3 class="font-medium text-slate-900">
                                    {{ $form->name }}
                                </h3>

                                <p class="text-sm text-slate-500">
                                    {{ $form->subject }}
                                </p>

                            </div>

                            <span class="text-xs text-slate-400 whitespace-nowrap">
                                {{ $form->created_at->diffForHumans() }}
                            </span>

                        </div>

                    @empty

                        <div class="py-12 text-center text-sm text-slate-400">
                            No contact forms yet.
                        </div>

                    @endforelse

                </div>

            </div>

            {{-- Recent Email Subscribers --}}
            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                    <h2 class="font-semibold text-slate-900">
                        Recent Email Subscribers
                    </h2>

                    <a href="{{ route('admin.form.index') }}" class="text-sm text-orange-500 hover:text-orange-600">
                        View All
                    </a>
                </div>

                <div class="divide-y divide-slate-100">

                    @forelse($recentEmailForms as $email)

                        <div class="flex items-start justify-between px-6 py-4">

                            <div>

                                <h3 class="font-medium text-slate-900">
                                    {{ $email->email }}
                                </h3>

                            </div>

                            <span class="text-xs text-slate-400 whitespace-nowrap">
                                {{ $email->created_at->diffForHumans() }}
                            </span>

                        </div>

                    @empty

                        <div class="py-12 text-center text-sm text-slate-400">
                            No email subscribers yet.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>
@endsection