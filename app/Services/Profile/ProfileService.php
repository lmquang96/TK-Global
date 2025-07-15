<?php

namespace App\Services\Profile;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileService
{
  public function uploadIdImage($file)
  {
    $mimeType = $file->getClientOriginalExtension();

    $path = Storage::disk('avatars')->putFileAs('', $file, time() . '_' . Str::uuid() . "." . $mimeType);

    return ['path' => 'assets/img/avatars/' . $path];
  }
}
