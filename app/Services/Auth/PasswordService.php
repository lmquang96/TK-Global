<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PasswordService
{
  const MSG_UPDATE_SUCCESS = 'Cập nhật thành công!';
  const MSG_UPDATE_ERROR = 'Cập nhật thất bại, vui lòng liên hệ với chúng tôi để khắc phục sự cố!';

  public function updatePass($request)
  {
    try {
      $user = Auth::user();
      $user->password = bcrypt($request->password);
      $user->save();

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
}
