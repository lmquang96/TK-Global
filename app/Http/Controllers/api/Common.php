<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class Common extends Controller
{
  public function getUrlsById(Request $request)
  {
    $id = $request->affId ?? null;
    $token = $request->token ?? null;

    if (!$this->verifyToken($token)) {
      return response([
        'status' => 'faild',
        'response' => []
      ], 400);
    }

    $urls = [];
    switch ($id) {
      case 'KT20250001':
        $urls = [
          'https://shopee.vn/',
          'https://tiki.vn/'
        ];
        break;

      default:
        # code...
        break;
    }
    return response([
      'status' => 'success',
      'response' => $urls
    ], 200);
  }

  public function flyIcon()
  {
    return view('content.common.flyicon');
  }

  private function verifyToken($token)
  {
    if (!$token) {
      return false;
    }

    if ($token != env('COMMON_TOKEN')) {
      return false;
    }

    return true;
  }
}
