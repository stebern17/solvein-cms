<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServicePoint;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function index(): JsonResponse
    {
        $services = Service::with('points')
        ->get()
        ->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description,
                'points' => $service->points->map(function ($point) {
                    return [
                        'id' => $point->id,
                        'point' => $point->title,
                        'order' => $point->order,
                    ];
                }),
            ];
        });

        return response()->json($services);
    }
}
