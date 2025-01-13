<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Main extends Controller
{
  public function index()
  {
    return view('content.profile.index');
  }

  public function changePass()
  {
    return view('content.profile.changePass');
  }
}
