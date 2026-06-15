<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Http\JsonResponse;

class FormController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $form = Form::create($validate);

        return response()->json([
            'success' => true,
            'message' => 'Form berhasil dikirim.',
            'data' => $form,
        ], 201);
    }
}
