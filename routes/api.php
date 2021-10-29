<?php

use App\Http\Controllers\LabelingController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('tag', TagController::class);

Route::post('picture/{tag}', [TagController::class, 'uploadPicture'])->name('upload.picture');
Route::delete('picture/{tag}', [TagController::class, 'destroyPicture'])->name('destroy.picture');

Route::post('taggable/{tag}/to/{type}/{id}', [LabelingController::class, 'add'])->name('labeling.add');
Route::delete('taggable/{taggable}', [LabelingController::class, 'remove'])->name('labeling.remove');
