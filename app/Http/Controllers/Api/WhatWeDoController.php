<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatWeDo;
use Illuminate\Http\JsonResponse;

class WhatWeDoController extends Controller
{
    public function index(): JsonResponse
    {
        $whatwedos = WhatWeDo::all()->map(function ($whatwedo) {
            return [
                'title-1' => $whatwedo->title_1,
                'description-1' => $whatwedo->description_1,
                'image-1' => $whatwedo->image_1,
                'title-2' => $whatwedo->title_2,
                'description-2' => $whatwedo->description_2,
                'image-2' => $whatwedo->image_2,
                'title-3' => $whatwedo->title_3,
                'description-3' => $whatwedo->description_3,
                'image-3' => $whatwedo->image_3,
            ];
        });
        return response()->json($whatwedos);
    }
}
