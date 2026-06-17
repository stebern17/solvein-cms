<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    public function index(): JsonResponse
    {
        $clients = Client::latest()->get()
        ->map(function ($client) {
            return [
                'id' => $client->id,
                'name' => $client->name,
                'logo' => $client->image,
            ];
        });
        return response()->json($clients);
    }
}
