<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserService
{
  const MSG_UPDATE_SUCCESS = 'Cập nhật thành công!';
  const MSG_UPDATE_ERROR = 'Cập nhật thất bại, vui lòng liên hệ với chúng tôi để khắc phục sự cố!';

  protected $user;

  public function __construct()
  {
    /** @var \App\Models\User $user */

    $this->user = Auth::user();
  }

  public function updatePersonalInfo($request)
  {
    $city = $request->city;
    $city_code = $city_name = null;
    if ($city) {
      $city = explode("|", $city);
      $city_code = $city[0];
      $city_name = $city[1];
    }

    if (!empty($this->user->profile)) {
      $profile = $this->user;
      $profile->name = $request->name;
      $profile->profile->phone = $request->phone;
      $profile->profile->address = $request->address;
      $profile->profile->city_code = $city_code;
      $profile->profile->city_name = $city_name;
      $profile->profile->account_type = $request->account_type;

      try {
        $profile->save();
        $profile->profile->save();
        $profile->refresh();

        return [
          'status' => true,
          'data' => self::MSG_UPDATE_SUCCESS
        ];
      } catch (\Throwable $th) {
        Log::error('Lỗi xảy ra khi cập nhật user profile: ' . $th->getMessage());

        return [
          'status' => false,
          'data' => self::MSG_UPDATE_ERROR
        ];
      }
    }

    return [
      'status' => false,
      'data' => self::MSG_UPDATE_ERROR
    ];
  }

  public function updatePaymentInfo($request)
  {
    $bank = $request->bank;
    $bank_code = $bank_name = null;
    if ($bank) {
      $bank = explode("|", $bank);
      $bank_code = $bank[0];
      $bank_name = $bank[1];
    }
    $profile = $this->user;
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

      return [
        'status' => true,
        'data' => self::MSG_UPDATE_SUCCESS
      ];
    } catch (\Throwable $th) {
      Log::error('Lỗi xảy ra khi cập nhật payment info: ' . $th->getMessage());

      return [
        'status' => false,
        'data' => self::MSG_UPDATE_ERROR
      ];
    }

    return [
      'status' => false,
      'data' => self::MSG_UPDATE_ERROR
    ];
  }

  public function updateAvatar($request)
  {
    $avatar = $request->file('avatar');
    try {
      $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
      $avatar->move(public_path('assets/img/avatars'), $avatarName);

      $profile = $this->user;
      $profile->profile->avatar = $avatarName;
      $profile->profile->save();

      return [
        'status' => true,
        'data' => self::MSG_UPDATE_SUCCESS
      ];
    } catch (\Throwable $th) {
      Log::error('Lỗi xảy ra khi cập nhật avatar: ' . $th->getMessage());

      return [
        'status' => false,
        'data' => self::MSG_UPDATE_ERROR
      ];
    }
  }
}
