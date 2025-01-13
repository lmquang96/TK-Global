<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Main extends Controller
{
  public function login()
  {
    return view('content.authentications.login');
  }

  public function register()
  {
    return view('content.authentications.register');
  }

  public function forgotPassword()
  {
    return view('content.authentications.forgot-password');
  }
}
