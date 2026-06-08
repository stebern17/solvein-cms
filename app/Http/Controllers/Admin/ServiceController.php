<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index(){
        $services = Service::with('points')->latest()->paginate(10);

        return view ('admin.services.index', compact('services'));
    }

    public function create(){
        return view('admin.services.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'json'],
            'points' => ['nullable', 'array'],
            'points.*' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $request->file('image')->store('services', 'public');

        $service = Service::create([
            'name' => $validated['name'],
            'image' => $imagePath,
            'description' => !empty($validated['description'])
                ? json_decode($validated['description'], true)
                : null,
        ]);

       if (!empty($validated['points'])) {
            foreach ($validated['points'] as $index => $pointTitle) {
                if (!$pointTitle) {
                    continue;
                }

                $service->points()->create([
                    'title' => $pointTitle,
                    'order' => $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service berhasil ditambahkan.');
    }

     public function edit(Service $service)
    {
        $service->load('points');

        return view('admin.services.edit', compact('service'));
    }
 public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'json'],
            'points' => ['nullable', 'array'],
            'points.*' => ['nullable', 'string', 'max:255'],
        ]);

        $imagePath = $service->image;

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            $imagePath = $request->file('image')->store('services', 'public');
        }

        $service->update([
            'name' => $validated['name'],
            'image' => $imagePath,
            'description' => !empty($validated['description'])
                ? json_decode($validated['description'], true)
                : null,
        ]);

        $service->points()->delete();

        if (!empty($validated['points'])) {
            foreach ($validated['points'] as $index => $pointTitle) {
                if (!$pointTitle) {
                    continue;
                }

                $service->points()->create([
                    'title' => $pointTitle,
                    'order' => $index + 1,
                ]);
            }
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service berhasil diperbarui.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service berhasil dihapus.');
    }
    
}
