<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\User\UserService;
use App\Services\Profile\ProfileService;

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

  public function updateIdImage(Request $request, ProfileService $profileService, UserService $userService)
  {
    $request->validate([
      'file_front' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
      'file_back' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ], [
      'file_front.required' => 'Ảnh mặt trước là bắt buộc',
      'file_front.image' => 'Ảnh mặt trước phải là file ảnh',
      'file_front.mimes' => 'Ảnh mặt trước không hỗ trợ định dạng này',
      'file_front.max' => 'Ảnh mặt trước kích thước tối đa là 2MB',
      'file_back.required' => 'Ảnh mặt sau là bắt buộc',
      'file_back.image' => 'Ảnh mặt sau phải là file ảnh',
      'file_back.mimes' => 'Ảnh mặt sau không hỗ trợ định dạng này',
      'file_back.max' => 'Ảnh mặt sau kích thước tối đa là 2MB'
    ]);

    $fileFront = $request->file('file_front');
    $fileBack = $request->file('file_back');
    $response = [];

    $response['front'] = $profileService->uploadIdImage($fileFront);
    $response['back'] = $profileService->uploadIdImage($fileBack);

    $doUpload = $userService->updateIdImage($response);

    if ($doUpload['status']) {
      return redirect()->back()->with('message', $doUpload['data']);
    }
    return redirect()->back()->withErrors(['message' => $doUpload['data']]);
  }
}
