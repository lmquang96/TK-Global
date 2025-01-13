<?php

namespace App\Http\Controllers\campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Main extends Controller
{
  public function index()
  {
    return view('content.campaigns.index');
  }

  public function detail()
  {
    return view('content.campaigns.detail');
  }

  public function getCampaigns()
  {
    $data = [
      [
        'mid' => '1',
        'name' => 'Shopee'
      ],
      [
        'mid' => '2',
        'name' => 'Lazada'
      ],
      [
        'mid' => '3',
        'name' => 'Tiki'
      ],
      [
        'mid' => '4',
        'name' => 'Shopee MCN'
      ],
    ];
    return response()->json($data, 200, []);
  }
}
