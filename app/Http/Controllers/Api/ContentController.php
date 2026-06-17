<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Http\JsonResponse;

class ContentController extends Controller
{
    public function index(): JsonResponse
    {
        $contents = Content::all()->map(function ($content) {
            return [
                'hero_section' => $content->hero_section,
                'about' => $content->about_solvein,
            ];
        });
        return response()->json($contents);
    }
}
