@extends('layouts.dashboardLayout')

@section('title', 'Add Clients')

@section('content')
    <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data" class="space-y-6"
        x-data="clientForm()">

        @csrf

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    <p class="font-semibold">Ada input yang belum sesuai.</p>
                    <ul class="mt-2 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="border-b border-slate-200 px-6 py-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Client Items</h3>
                    <p class="mt-1 text-sm text-slate-500">
                        Isi nama client dan upload logo/icon client.
                    </p>
                </div>

                <a href="{{ route('admin.clients.index') }}"
                    class="rounded-full border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-950 hover:text-slate-950">
                    Back
                </a>
            </div>

            <div class="space-y-5 p-6">
                <template x-for="(item, index) in items" :key="item.id">
                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">
                                    Client <span x-text="index + 1"></span>
                                </h4>
                                <p class="mt-1 text-xs text-slate-500">
                                    Name dan logo client.
                                </p>
                            </div>

                            <button type="button" x-show="items.length > 1" @click="removeItem(index)"
                                class="rounded-full bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-100">
                                Remove
                            </button>
                        </div>

                        <div class="grid gap-5 lg:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-800">
                                    Client Name
                                </label>
                                <input type="text" name="names[]"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                    placeholder="Contoh: PT Example Indonesia" required>
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-800">
                                    Client Logo / Icon
                                </label>
                                <input type="file" name="images[]"
                                    accept="image/jpeg,image/png,image/gif,image/webp,image/svg+xml"
                                    @change="previewImage(index, $event)"
                                    class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 file:mr-4 file:rounded-full file:border-0 file:bg-slate-950 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-orange-600"
                                    required>

                                <div class="mt-4 overflow-hidden rounded-lg border border-slate-200 bg-white">
                                    <template x-if="item.imagePreview">
                                        <img :src="item.imagePreview" alt="Client preview"
                                            class="aspect-video w-full object-contain p-5">
                                    </template>

                                    <div x-show="!item.imagePreview"
                                        class="flex aspect-video items-center justify-center px-4 text-center text-sm text-slate-400">
                                        Image preview
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <button type="button" @click="addItem()"
                    class="rounded-full border border-dashed border-slate-400 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-orange-500 hover:text-orange-600">
                    + Add More Client
                </button>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="rounded-full bg-slate-950 px-6 py-3 text-sm font-semibold text-white transition hover:bg-orange-600">
                Save Clients
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        function clientForm() {
            return {
                items: [{
                    id: Date.now(),
                    imagePreview: null
                }],

                addItem() {
                    this.items.push({
                        id: Date.now() + Math.random(),
                        imagePreview: null
                    });
                },

                removeItem(index) {
                    this.revokePreview(this.items[index]);
                    this.items.splice(index, 1);
                },

                previewImage(index, event) {
                    const file = event.target.files?.[0];

                    if (!file) {
                        this.revokePreview(this.items[index]);
                        this.items[index].imagePreview = null;
                        return;
                    }

                    this.revokePreview(this.items[index]);
                    this.items[index].imagePreview = URL.createObjectURL(file);
                },

                revokePreview(item) {
                    if (item?.imagePreview) {
                        URL.revokeObjectURL(item.imagePreview);
                    }
                }
            }
        }
    </script>
@endpush
