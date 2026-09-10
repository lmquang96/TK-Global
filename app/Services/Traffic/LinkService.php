<?php

namespace App\Services\Traffic;

use Illuminate\Support\Facades\Auth;
use App\Models\LinkHistory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class LinkService
{
  const PER_PAGE = 25;

  public function getHistoriesByCampagin($campaignId)
  {
    return LinkHistory::where('user_id', Auth::user()->id)
      ->where('campaign_id', $campaignId)
      ->limit(5)
      ->get();
  }

  public function storeHistory($request)
  {
    $linkHistory = new LinkHistory;

    $linkHistory->code = sha1(time());
    $linkHistory->original_url = $request->originalLink;
    $linkHistory->domain = $request->domain;
    $linkHistory->short_url = null;
    $linkHistory->sub1 = $request->sub1;
    $linkHistory->sub2 = $request->sub2;
    $linkHistory->sub3 = $request->sub3;
    $linkHistory->sub4 = $request->sub4;
    $linkHistory->user_id = Auth::user()->id;
    $linkHistory->campaign_id = $request->campaignId;

    try {
      $linkHistory->save();

      return [
        'status' => true,
        'data' => $linkHistory->code
      ];
    } catch (\Throwable $th) {
      Log::error('Lỗi xảy ra khi lưu lịch sử tạo link: ' . $th->getMessage());

      return [
        'status' => false,
        'data' => $th->getMessage()
      ];
    }
  }

  public function getHistories($request)
  {
    $perPage = self::PER_PAGE;

    return LinkHistory::where('user_id', Auth::user()->id)
      ->when($request->keyword, function ($q, $keyword) {
        return $q->whereHas('campaign', function ($query) use ($keyword) {
          $query->where('name', 'like', '%' . $keyword . '%');
        });
      })
      ->when($request->date, function ($q, $date) {
        $dateArray = explode(" - ", $date);
        $q->whereBetween('created_at', [$dateArray[0] . ' 00:00:00', $dateArray[1] . ' 23:59:59']);
      })
      ->paginate($perPage);
  }

  public function createLinkTiktok($request)
  {
    // $token = $this->getTiktokToken();

    $this->getLinkTiktok();
  }

  private function getLinkTiktok()
  {
    $accessToken = 'ROW_BQ_b2gAAAABwr-_kjfieGD29cLJ6cN-0-BT-gTVx5ArfIkBryYo4zZxwbCVkoUD21es0k12ddaludFLlaR-p4uDuRqYX9QFw';

    $refreshToken = 'ROW__H3z-QAAAAAexlBo9rTYwTMJpGzV_oQ3_ceKlXLXSZV1sFDJ7XewsQV_MX2s9_nAL00ib0Mrarq7MbYVEyG4jHupQy086gGS';

    $appKey    = '6kubi5giv16is';
    $appSecret = '92156d68fb3ff44011d111a8ef497db4870b91cc';
    $path   = '/affiliate_creator/202505/affiliate_sharing_links/general_publishers/generate_batch';


    $timestamp = (string) time();

    $query = [
      'app_key' => $appKey,
      'timestamp' => $timestamp,
    ];

    $body = json_encode([
      'material' => [
        'ids' => [
          '1729663172583984027',
        ],
        'type' => 'PRODUCT',
      ],
    ], JSON_UNESCAPED_SLASHES);

    $result = $this->generateTikTokSign(
      $appSecret,
      $path,
      $query,
      $body
    );

    $sign = $result['sign'];

    $url = 'https://open-api.tiktokglobalshop.com'
      . $path
      . '?'
      . http_build_query([
        'app_key' => $appKey,
        'timestamp' => $timestamp,
        'sign' => $sign,
      ]);

    $response = Http::withHeaders([
      'Content-Type' => 'application/json',
      'x-tts-access-token' => $accessToken,
    ])->withBody(
      $body,
      'application/json'
    )->post($url);
    dd($response->json());
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
