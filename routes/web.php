<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadController;

Route::get('upload', [UploadController::class, 'imageUpload'])->name('image.upload');
Route::post('upload', [UploadController::class, 'imageUploadPost'])->name('image.upload.post');

Route::get('/', function () {
    return view('upload');
});
