<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class Main extends Controller
{
  const MSG_UPDATE_SUCCESS = 'Cập nhật thành công!';
  const MSG_UPDATE_ERROR = 'Cập nhật thất bại, vui lòng liên hệ với chúng tôi để khắc phục sự cố!';

  public function index()
  {
    return view('content.profile.index');
  }

  public function updatePersonalInfo(Request $request) {
    $city = $request->city;
    $city_code = $city_name = null;
    if ($city) {
      $city = explode("|", $city);
      $city_code = $city[0];
      $city_name = $city[1];
    }
    $profile = auth()->user();
    $profile->name = $request->name;
    $profile->profile->phone = $request->phone;
    $profile->profile->address = $request->address;
    $profile->profile->city_code = $city_code;
    $profile->profile->city_name = $city_name;
    $profile->profile->account_type = $request->account_type;

    try {
      $profile->save();
      $profile->profile->save();

      return redirect()->back()->with('message', self::MSG_UPDATE_SUCCESS);
    } catch (\Exception $e) {
      \Log::error($e->getMessage());

      return redirect()->back()->withErrors(['message' => self::MSG_UPDATE_ERROR]);
    } 
  }

  public function updatePaymentInfo(Request $request) {
    $bank = $request->bank;
    $bank_code = $bank_name = null;
    if ($bank) {
      $bank = explode("|", $bank);
      $bank_code = $bank[0];
      $bank_name = $bank[1];
    }
    $profile = auth()->user();
    $profile->profile->bank_owner = $request->bank_owner;
    $profile->profile->bank_number = $request->bank_number;
    $profile->profile->bank_code = $bank_code;
    $profile->profile->bank_name = $bank_name;
    $profile->profile->bank_branch = $request->bank_branch;
    $profile->profile->citizen_id_no = $request->citizen_id_no;
    $profile->profile->citizen_id_date = $request->citizen_id_date;
    $profile->profile->citizen_id_place = $request->citizen_id_place;
    $profile->profile->tax = $request->tax;

    try {
      $profile->profile->save();

      return redirect()->back()->with('message', self::MSG_UPDATE_SUCCESS);
    } catch (\Exception $e) {
      \Log::error($e->getMessage());

      return redirect()->back()->withErrors(['message' => self::MSG_UPDATE_ERROR]);
    } 
  }

  public function updateAvatar(Request $request) {
    $request->validate([
      'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file phải là ảnh
    ]);

    $avatar = $request->file('avatar');
    try {
      $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
      $avatar->move(public_path('assets/img/avatars'), $avatarName);

      $profile = auth()->user();
      $profile->profile->avatar = $avatarName;
      $profile->profile->save();

      return back()->with('message', self::MSG_UPDATE_SUCCESS);
    } catch (\Exception $e) {
      dd($e);
    }
  }

  public function changePass()
  {
    return view('content.profile.changePass');
  }
}
