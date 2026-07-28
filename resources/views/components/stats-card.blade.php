<div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-slate-500">
                {{ $title }}
            </p>

            <h2 class="mt-2 text-3xl font-bold">
                {{ $value }}
            </h2>
        </div>

        <div class="rounded-lg bg-orange-100 p-3">
            {{ $icon }}
        </div>
    </div>
</div>