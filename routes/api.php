<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FormController;
use App\Http\Controllers\Api\EmailFormController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\WhatWeDoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/forms', [FormController::class, 'store']);
Route::post('/email-forms', [EmailFormController::class, 'store']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/contents', [ContentController::class, 'index']);
Route::get('/what-we-do', [WhatWeDoController::class, 'index']);

