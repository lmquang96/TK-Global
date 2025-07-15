<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TransitionImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UploadOrderJob;
use App\Jobs\UpdateOrderJob;
use App\Models\Config;
use Carbon\Carbon;
use App\Services\Profile\ProfileService;

class Upload extends Controller
{
  public function upload(Request $request)
  {
    $rules = [
      'mid' => 'required',
      'file' => 'required|file',
      'extension' => 'required|in:csv,xlsx,xls'
    ];

    $message = [
      'in' => 'Only accept csv, xlsx, xls files'
    ];

    $request->request->add(['extension' => strtolower($request->file->getClientOriginalExtension())]);

    $validator = Validator::make($request->all(), $rules, $message);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $mid = $request->mid;
    $file = $request->file('file');

    $data = Excel::toArray(new TransitionImport(), $file);

    try {
      UploadOrderJob::dispatch($mid, $data);

      return response()->json([
        'status' => 200,
        'data' => [
          'count' => count($data[0])
        ]
      ]);
    } catch (\Exception $e) {
      \Log::error("------1--------");
      \Log::error($e->getMessage());
      \Log::error("------1--------");

      return response()->json([
        'status' => 400,
        'data' => $e->getFile()
      ]);
    }
  }

  public function storeAds(Request $request)
  {
    $array = Excel::toArray(new TransitionImport(), $request->file('file'));
    $adsData = [];

    foreach ($array as $sheet) {
      foreach ($sheet as $key => $row) {
        $adsData[$row['adid']] = [
          'sub1' => $row['label1'],
          'sub2' => $row['label2'],
          'sub3' => $row['label3']
        ];
      }
    }

    // Config::where('name', $request->mid . '_ads')
    //   ->update([
    //     'value' => json_encode($adsData),
    //     'updated_at' => Carbon::now()
    //   ]);

    Config::query()
      ->insert([
        'name' => $request->mid . '_ads',
        'value' => json_encode($adsData),
        'created_at' => Carbon::now(),
      ]);

    return response()->json([
      'status' => 200,
      'data' => $adsData
    ]);
  }

  public function update(Request $request)
  {
    $rules = [
      'mid' => 'required',
      'file' => 'required|file',
      'extension' => 'required|in:csv,xlsx,xls'
    ];

    $message = [
      'in' => 'Only accept csv, xlsx, xls files'
    ];

    $request->request->add(['extension' => strtolower($request->file->getClientOriginalExtension())]);

    $validator = Validator::make($request->all(), $rules, $message);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $mid = $request->mid;
    $file = $request->file('file');

    $data = Excel::toArray(new TransitionImport(), $file);

    try {
      UpdateOrderJob::dispatch($mid, $data);

      return response()->json([
        'status' => 200,
        'data' => [
          'count' => count($data[0])
        ]
      ]);
    } catch (\Exception $e) {
      \Log::error("------1--------");
      \Log::error($e->getMessage());
      \Log::error("------1--------");

      return response()->json([
        'status' => 400,
        'data' => $e->getFile()
      ]);
    }
  }

  public function uploadImage(Request $request, ProfileService $profileService)
  {
    $request->validate([
      'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $response = $profileService->uploadIdImage($request);

    return response()->json($response);
  }
}
