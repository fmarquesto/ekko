<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('images/{page}', [ImageController::class, 'images']);
