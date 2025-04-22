<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;

class Main extends Controller
{
  public function index()
  {
    return view('content.profile.index');
  }

  public function updatePersonalInfo(Request $request, UserService $userService)
  {
    $updatePersonalInfo = $userService->updatePersonalInfo($request);

    if ($updatePersonalInfo['status']) {
      return redirect()->back()->with('message', $updatePersonalInfo['data']);
    }
    return redirect()->back()->withErrors(['message' => $updatePersonalInfo['data']]);
  }

  public function updatePaymentInfo(Request $request, UserService $userService)
  {
    $updatePaymentInfo = $userService->updatePaymentInfo($request);

    if ($updatePaymentInfo['status']) {
      return redirect()->back()->with('message', $updatePaymentInfo['data']);
    }
    return redirect()->back()->withErrors(['message' => $updatePaymentInfo['data']]);
  }

  public function updateAvatar(Request $request, UserService $userService)
  {
    $request->validate([
      'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file phải là ảnh
    ]);

    $updateAvatar = $userService->updateAvatar($request);

    if ($updateAvatar['status']) {
      return redirect()->back()->with('message', $updateAvatar['data']);
    }
    return redirect()->back()->withErrors(['message' => $updateAvatar['data']]);
  }

  public function changePass()
  {
    return view('content.profile.changePass');
  }
}
