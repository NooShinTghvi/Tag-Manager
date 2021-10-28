<?php

use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('tag', TagController::class);

Route::post('picture/{tag}', [TagController::class, 'uploadPicture'])->name('upload.picture');
Route::delete('picture/{tag}', [TagController::class, 'destroyPicture'])->name('destroy.picture');
