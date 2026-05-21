<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Upload;
use App\Http\Controllers\Postback;
use App\Http\Controllers\api\Common;
use App\Models\CampaignPostback;
use App\Models\Conversion;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('uploadOrder')->group(function () {
  Route::post('/upload', [Upload::class, 'upload']);
  Route::post('/update', [Upload::class, 'update']);

  Route::post('/storeAds', [Upload::class, 'storeAds']);
});

Route::post('/uploadImage', [Upload::class, 'uploadImage']);

Route::get('/involve/postback', [Postback::class, 'involve']);
Route::get('/partnerize/postback', [Postback::class, 'partnerize']);
Route::get('/postback/scan', [Postback::class, 'scan']);

Route::get('/common/get-urls-by-id', [Common::class, 'getUrlsById']);

Route::get('/test', function() {
  $data = CampaignPostback::where('source', 'partnerize')->where('data', 'like', '%"conversion_type":"11"%')
  ->whereBetween('created_at', ['2026-05-15 00:00:00', '2026-05-20 23:59:59'])->get();
  $orderList = [];
  foreach ($data as $key => $item) {
    $itemObject = $item->data;
    $itemDetail = json_decode($itemObject);
    $orderList[] = $itemDetail->conversion_id;
  }
  // dd($orderList);
  $data = Conversion::whereIn('order_code', $orderList)->get();
  dd($data);
});
