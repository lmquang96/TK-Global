<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\CommissionRate;
use App\Models\Click;
use App\Models\Conversion;
use App\Models\Config;
use App\Models\Profile;

class ScanTikTokShopService
{
  const USD_VND_RATE = 22500;
  const VAT_RATE = 1.08;

  private string $baseUrl = 'https://open-api.tiktokglobalshop.com';

  public function scan(int $timeGe, int $timeLt, int $pageSize = 100, ?string $pageToken = null)
  {
    $path = '/affiliate_creator/202410/orders/search';
    $appKey    = '6locfdh94v0q2';
    $appSecret = '21e11117be3a4f566285388741ffd2e11c2dcaf3';
    $accessToken = $this->getAccessToken();;

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

    $orders = data_get($result, 'data.orders');

    if (!$orders) {
      return true;
    }

    $insertData = [];
    $cidinfo = [];

    foreach ($orders as $key => $order) {
      if ($order['status'] == 'REFUNDED') {
        continue;
      }
      $item = data_get($order, 'skus.0');
      $price = data_get($item, 'price.amount') ? (int) preg_replace('/[^\d]/u', '', data_get($item, 'price.amount')) : 0;
      $sumcom = data_get($item, 'estimated_commission.amount') ? (int) preg_replace('/[^\d]/u', '', data_get($item, 'estimated_commission.amount')) : 0;
      $clickId = data_get($item, 'trace_info.id');

      $click = Click::query()
        ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
        ->select('link_histories.*', 'clicks.id as click_id')
        ->where('clicks.code', $clickId)
        ->where('link_histories.campaign_id', 75)
        ->first();

      if (!$click) {
        continue;
      }

      $accountType = Profile::where('user_id', $click->user_id)->pluck('account_type')->first();

      $foreignVAT = $this->getForeignVAT($accountType);
      $saleVAT = $this->getSaleVAT($accountType);

      $comRate = CommissionRate::where('user_id', $click->user_id)
        ->pluck('rate')->first();

      if (!$comRate) {
        $comRate = 0.8;
      }

      $comRate = floatval($comRate);

      $insertData[] = [
        'code' => sha1(time() + $key),
        'order_code' => $order['id'],
        'order_time' => Carbon::createFromTimestamp($order['create_time'])->format('Y-m-d H:i:s'),
        'unit_price' => floatval($price) / ($saleVAT * $foreignVAT),
        'quantity' => $item['quantity'],
        'commission_pub' => floatval($sumcom) * $comRate / (self::VAT_RATE * $foreignVAT),
        'commission_sys' => floatval($sumcom) * (1 - $comRate) / self::VAT_RATE * $foreignVAT,
        'status' => $order['status'] == 'REFUNDED' ? 'Cancelled' : 'Pending',
        'product_code' => $item['id'] . '-' . $item['product_id'],
        'product_name' => $item['product_name'],
        'campaign_id' => $click->campaign_id,
        'click_id' => $click->click_id,
        'user_id' => $click->user_id,
        'updated_at' => now(),
      ];

      $cidinfo[$click->click_id] = $click;
    }

    $chunks = array_chunk($insertData, 100);

    foreach ($chunks as $key => $chunk) {
      Conversion::upsert(
        $chunk,
        [
          'campaign_id',
          'order_code',
          'product_code',
        ],
        [
          'unit_price',
          'quantity',
          'commission_pub',
          'commission_sys',
          'status',
          'updated_at',
        ]
      );

      foreach ($chunk as $key => $item) {
        $this->callUserPostback($item, $cidinfo);
      }
    }
  }

  private function callUserPostback($item, $cidinfo)
  {
    switch ($item['user_id']) {
      case 66:
        $subid = $cidinfo[$item['click_id']]['sub1'] ?? '';
        $payout = $item['commission_pub']/26000;
        $url = 'https://blnciaga.com/1e52a83/postback';

        $response = Http::get($url, [
          'subid' => $subid,
          'payout' => $payout,
          'status' => 'lead'
        ]);

        Log::info($response->json());

        break;

      default:
        # code...
        break;
    }
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

  private function getAccessToken()
  {
    $endpoint = 'https://auth.tiktok-shops.com/api/v2/token/refresh';
    $accessToken = Cache::get('tiktok_access_token');

    if (!$accessToken) {
      $refreshToken = Cache::get('tiktok_refresh_token');

      if (!$refreshToken) {
        $refreshToken = Config::where('name', 'tiktok_refresh_token')->pluck('value')->first();
      }

      try {
        $response = Http::get($endpoint, [
          'app_key' => '6locfdh94v0q2',
          'refresh_token' => $refreshToken,
          'grant_type' => 'refresh_token'
        ]);

        $response = $response->json();

        $accessToken = data_get($response, 'data.access_token');
        $accessTokenExpire = data_get($response, 'data.access_token_expire_in');
        $refreshToken = data_get($response, 'data.refresh_token');
        $refreshTokenExpire = data_get($response, 'data.refresh_token_expire_in');

        Cache::put('tiktok_refresh_token', $refreshToken, Carbon::createFromTimestamp((int) $refreshTokenExpire));

        Config::where('name', 'tiktok_refresh_token')->update([
          'value' => $refreshToken
        ]);

        Cache::put('tiktok_access_token', $accessToken, Carbon::createFromTimestamp((int) $accessTokenExpire));
      } catch (\Throwable $th) {
        Log::error('Lỗi xảy ra khi lấy access token tiktok: ' . $th->getMessage());
      }
    }

    return $accessToken;
  }

  private function getForeignVAT($type) {
    $rate = 1;
    switch ($type) {
      case 'domestic_individual':
        $rate = 1;
        break;

      case 'individual_business':
        $rate = 1;
        break;

      case 'domestic_company':
        $rate = 1;
        break;

      case 'foreign_individual':
        $rate = 1.1;
        break;

      case 'foreign_company':
        $rate = 1.1;
        break;
      
      default:
        # code...
        break;
    }

    return $rate;
  }

  private function getSaleVAT($type) {
    $rate = 1;
    switch ($type) {
      case 'domestic_individual':
        $rate = 1;
        break;

      case 'individual_business':
        $rate = 1;
        break;

      case 'domestic_company':
        $rate = 1;
        break;

      case 'foreign_individual':
        $rate = self::VAT_RATE;
        break;

      case 'foreign_company':
        $rate = self::VAT_RATE;
        break;
      
      default:
        # code...
        break;
    }

    return $rate;
  }
}
