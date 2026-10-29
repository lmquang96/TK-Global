<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ScanTikTokShopService
{
  private string $baseUrl = 'https://open-api.tiktokglobalshop.com';

  public function scan($timeGe, $timeLt, int $pageSize = 20, ?string $pageToken = null)
  {
    $path = '/affiliate_creator/202410/orders/search';
    $appKey    = '6locfdh94v0q2';
    $appSecret = '21e11117be3a4f566285388741ffd2e11c2dcaf3';
    $accessToken = 'ROW_Nv2O5QAAAACY3gRglKiHdmPBGimNqqR1Qh1Me5ptOk-q_BCHM7asj9jHvfv76J79aBurL0Na-GFHyu0zlA4yxmi9X6lkMgp4Zm-pfk4X3PUpP1ei62VKMA';

    $body = [
      'create_time_ge'   => $timeGe,
      'create_time_lt'   => $timeLt
    ];

    $query = [
      'app_key'    => $appKey,
      'timestamp'  => time(),
      'page_size'  => $pageSize,
    ];

    if ($pageToken !== null) {
      $query['page_token'] = $pageToken;
    }

    $query['sign'] = $this->generateTikTokSign(
      $appSecret,
      $path,
      $query,
      json_encode($body)
    )['sign'];

    $response = Http::withHeaders([
      'content-type'      => 'application/json',
      'x-tts-access-token' => $accessToken,
    ])
      ->post(
        $this->baseUrl . $path . '?' . http_build_query($query),
        $body
      );

    $result = $response->json();

    dd($result);
  }

  function generateTikTokSign(
    string $appSecret,
    string $path,
    array $queryParams,
    string $body = ''
  ): array {
    unset($queryParams['sign'], $queryParams['access_token']);

    ksort($queryParams);

    $signString = $path;

    foreach ($queryParams as $key => $value) {
      $signString .= $key . (string) $value;
    }

    $signString .= $body;

    $signString = $appSecret . $signString . $appSecret;


    // 5. Generate the HMAC-SHA256 hash in lowercase hex
    $sign = hash_hmac(
      'sha256',
      $signString,
      $appSecret
    );

    return [
      'sign' => $sign,
      'sign_string' => $signString,
    ];
  }
}
