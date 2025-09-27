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
      case 'TK20250026':
        $shopeeUrl = [
          'https://s.shopee.vn/3fuafr9jUd',
          'https://s.shopee.vn/4AqrGm7pTk',
          'https://s.shopee.vn/40XR4T8Soj',
          'https://s.shopee.vn/4VThfO6Ynq',
          'https://s.shopee.vn/4LAHT57C8p',
          'https://s.shopee.vn/4q6Y405I7w',
          'https://s.shopee.vn/4fn7rh5vSv',
          'https://s.shopee.vn/5AjOSc41S2',
          'https://s.shopee.vn/50PyGJ4en1',
          'https://s.shopee.vn/BKiVQN3b6',
          'https://s.shopee.vn/11IJ7Ngw5',
          'https://s.shopee.vn/VxYu2LmvC',
          'https://s.shopee.vn/Le8hjMQGB',
          'https://s.shopee.vn/qaPIeKWFI',
          'https://s.shopee.vn/gGz6LL9aH',
          'https://s.shopee.vn/1BDFhGJFZO',
          'https://s.shopee.vn/10tpUxJsuN',
          'https://s.shopee.vn/1Vq65sHytU',
          'https://s.shopee.vn/1LWftZIcET',
          'https://s.shopee.vn/1qSwUUGiDa'
        ];
        $tiktokUrls = ['https://vt.tiktok.com/ZSHWS2seLNuBA-JrOK8/'];
        $urls[] = $shopeeUrl[rand(0, count($shopeeUrl) - 1)];
        $urls[] = $tiktokUrls[0];
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
