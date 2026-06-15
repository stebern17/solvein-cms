<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'names' => ['required', 'array', 'min:1'],
            'names.*' => ['required', 'string', 'max:255'],

            'images'=> ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif,svg,webp'],
        ]);

       foreach ($validated['names'] as $index => $name) {
            if (!$request->hasFile("images.$index")) {
                continue;
            }

            $imagePath = $request->file("images.$index")->store('clients', 'public');

            Client::create([
                'name' => $name,
                'image' => $imagePath,
            ]);
        }

        return redirect()->route('admin.clients.index')->with('success', 'Clients created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.client.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif,svg,webp'],
        ]);

        if ($request->hasFile('image')) {
            if ($client->image) {
                Storage::disk('public')->delete($client->image);
            }

            $validated['image'] = $request->file('image')->store('clients', 'public');
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        if ($client->image) {
            Storage::disk('public')->delete($client->image);
        }

        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
