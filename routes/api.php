<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Upload;
use App\Http\Controllers\Postback;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('uploadOrder')->group(function () {
  Route::post('/upload', [Upload::class, 'upload']);
  Route::post('/update', [Upload::class, 'update']);

  Route::post('/storeAds', [Upload::class, 'storeAds']);
});


Route::get('/involve/postback', [Postback::class, 'involve']);
Route::get('/postback/scan', [Postback::class, 'scan']);
