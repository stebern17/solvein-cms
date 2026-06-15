<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\EmailFormController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/forms', [FormController::class, 'store']);
Route::post('/email-forms', [EmailFormController::class, 'store']);
