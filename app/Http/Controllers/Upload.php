<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\TransitionImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Jobs\UploadOrderJob;

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
      \Log::error("--------------");
      \Log::error($e->getMessage());
      \Log::error("--------------");

      return response()->json([
        'status' => 400,
        'data' => $e->getMessage()
      ]);
    }
  }
}
