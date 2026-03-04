<?php

namespace App\Services;

use App\Models\CampaignPostback;
use App\Models\Click;
use App\Models\Conversion;
use App\Models\Profile;
use Carbon\Carbon;
use App\Models\CommissionRate;

class ScanPartnerizeService
{
  const USD_VND_RATE = 22500;
  const VAT_RATE = 1.1;

  public function scan($startDate, $endDate)
  {
    $token = "cDN0ZXcxNDV5M3RhZzQxbjpOenkyOVM2Yg==";
    $pId = "1011l398764";

    $filters = [
        'start_date' => $startDate."T00:00:00",
        'end_date' => $endDate."T23:59:59",
        'timezone' => 'Asia/Ho_Chi_Minh'
    ];

    $headers = [
        'Authorization: Basic ' . $token,
        'Content-Type: application/json',
    ];

    $query = http_build_query($filters);

    $url = "https://api.partnerize.com/reporting/report_publisher/publisher/$pId/conversion.json?".$query;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);

    if (!empty($response['error'])) {
      Log::error(
          'Call api optimise Fail:' .
          ' Message: ' . json_encode($response['error'])
      );
    }

    $data = json_decode($response, true);

    foreach ($data['conversions'] as $key => $item) {
      $item = $item['conversion_data'];
      $itemDetails = $item['conversion_items'];
      $purchaseTime = $item['conversion_time'];
      foreach ($itemDetails as $subkey => $itemDetail) {
        $click = Click::query()
        ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
        ->select('link_histories.*', 'clicks.id as click_id')
        ->where('clicks.code', $item['publisher_reference'])
        ->first();

        $sales = (floatval($itemDetail['item_value']) * self::USD_VND_RATE) / self::VAT_RATE;
        $sumcom = (floatval($itemDetail['item_publisher_commission']) * self::USD_VND_RATE) / self::VAT_RATE;

        $comRate = CommissionRate::where('user_id', $click->user_id)
        ->pluck('rate')->first();

        if (!$comRate) {
          $comRate = 0.7;
        }

        $comRate = floatval($comRate);

        Conversion::upsert([
          'code' => sha1(time() + ($key * 10 + $subkey)),
          'order_code' => $item['conversion_id'],
          'order_time' => Carbon::createFromFormat('Y-m-d H:i:s', $purchaseTime)->format('Y-m-d H:i:s'),
          'unit_price' => $sales,
          'quantity' => 1,
          'commission_pub' => $sumcom * $comRate,
          'commission_sys' => $sumcom * (1 - $comRate),
          'status' => $itemDetail['item_status'] == 'CANCELLED' ? 'Cancelled' : ($itemDetail['item_status'] == 'CONFIRMED' ? 'Approved' : 'Pending'),
          'product_code' => $itemDetail['conversion_item_id'],
          'product_name' => $itemDetail['category'],
          'campaign_id' => $click->campaign_id,
          'click_id' => $click->click_id,
          'user_id' => $click->user_id,
          'updated_at'    => now(),
          'comment' => 'scan from api'
        ], [
          'campaign_id',
          'order_code',
          'product_code',
        ], [
          'unit_price',
          'quantity',
          'commission_pub',
          'commission_sys',
          'status',
          'updated_at',
        ]);
      }
    }

    return true;
  }
}
