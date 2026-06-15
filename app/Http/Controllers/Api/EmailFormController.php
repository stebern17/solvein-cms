<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailForm;
use Illuminate\Http\JsonResponse;

class EmailFormController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $emailForm = EmailForm::create($validate);

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil dikirim.',
            'data' => $emailForm,
        ], 201);

    }
}
