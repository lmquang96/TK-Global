<?php

namespace App\Http\Controllers\guides;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Main extends Controller
{
  public function termsOfService()
  {
    return view('content.guides.termsOfService');
  }

  public function privacyPolicy()
  {
    return view('content.guides.privacyPolicy');
  }
}
