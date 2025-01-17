<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;

class Main extends Controller
{
  public function login()
  {
    return view('content.authentications.login');
  }

  public function authenticate(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email', 'max:50'],
      'password' => ['required', 'max:50', 'regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/u'],
    ]);

    $remember = $request->remember ? true : false;

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();

      return redirect()->intended('dashboard');
    }

    return back()->withErrors([
      'email' => 'Thông tin đăng nhập không chính xác.',
    ])->withInput();
  }

  public function register()
  {
    return view('content.authentications.register');
  }

  public function storeUser(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email', 'max:50', 'unique:users,email'],
      'name' => ['required', 'max:50', 'regex:/^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*){1,}$/u'],
      'password' => ['required', 'max:50', 'regex:/^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/u'],
    ], [
      'email.unique' => 'Email đã tồn tại'
    ]);

    try {
      $userId = User::create([
        'email' => $request->email,
        'name' => $request->name,
        'password' => $request->password
      ])->id;

      Profile::create([
        'user_id' => $userId
      ]);

      return redirect('login');
    } catch (\Exception $e) {
      \Log::error($e->getMessage());
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

  public function forgotPassword()
  {
    return view('content.authentications.forgot-password');
  }
}
