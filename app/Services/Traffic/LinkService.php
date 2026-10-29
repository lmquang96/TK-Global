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
    $this->getLinkTiktok();
  }

  private function getLinkTiktok()
  {
    $accessToken = 'ROW_Nv2O5QAAAACY3gRglKiHdmPBGimNqqR1Qh1Me5ptOk-q_BCHM7asj9jHvfv76J79aBurL0Na-GFHyu0zlA4yxmi9X6lkMgp4Zm-pfk4X3PUpP1ei62VKMA';

    $refreshToken = 'ROW_y3dljwAAAACMR4Z2gLlrZYIz86VFtx8GmXXerX0eP91ns4WjpRe87ZgRUGspKCRzEBCHF0PIyvTX-j9QBBPQ2IXBZvKqjRnS';

    $appKey    = '6locfdh94v0q2';
    $appSecret = '21e11117be3a4f566285388741ffd2e11c2dcaf3';
    $path   = '/affiliate_creator/202505/affiliate_sharing_links/general_publishers/generate_batch';


    $timestamp = (string) time();

    $query = [
      'app_key' => $appKey,
      'timestamp' => $timestamp,
    ];

    $body = json_encode([
      'material' => [
        'ids' => [
          '1731519725176587399',
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
