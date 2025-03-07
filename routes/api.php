<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Upload;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('uploadOrder')->group(function () {
  Route::post('/upload', [Upload::class, 'upload']);

  Route::post('/storeAds', [Upload::class, 'storeAds']);
});
