<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Main extends Controller
{
  public function performance()
  {
    return view('content.report.performance');
  }

  public function order()
  {
    return view('content.report.order');
  }
}
