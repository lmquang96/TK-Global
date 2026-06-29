<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;

class RegisterService
{

  public function createUser($request)
  {
    try {
      $userId = User::create([
        'email' => $request->email,
        'name' => $request->name,
        'password' => $request->password
      ])->id;

      Profile::create([
        'user_id' => $userId,
        'phone' => $request->phone
      ]);
    } catch (\Throwable $th) {
      Log::error('Lỗi xảy ra khi tạo user: ' . $th->getMessage());
    }
  }
}
