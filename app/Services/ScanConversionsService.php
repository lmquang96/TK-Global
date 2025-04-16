<?php

namespace App\Services;

use App\Models\CampaignPostback;
use App\Models\Click;
use App\Models\Conversion;

class ScanConversionsService
{
  const USD_VND_RATE = 22500;
  
  public function scan()
  {
    $postbackList = CampaignPostback::where('status', 0)->get();

    foreach ($postbackList as $key => $postback) {

      $data = json_decode($postback->data);

      if ($data->status == 'pending') {
        $click = Click::query()
          ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
          ->select('link_histories.*', 'clicks.id as click_id')
          ->where('clicks.code', $data->aff_sub)
          ->first();

        $sales = floatval($data->usd_sale_amount) * self::USD_VND_RATE;
        $sumcom = floatval($data->usd_payout) * self::USD_VND_RATE;

        if ($click) {
          Conversion::create([
            'code' => sha1(time() + $key),
            'order_code' => $data->conversion_id,
            'order_time' => $data->datetime_conversion,
            'unit_price' => $sales,
            'quantity' => 1,
            'commission_pub' => $sumcom * 0.7,
            'commission_sys' => $sumcom * 0.3,
            'status' => 'Pending',
            'product_code' => $data->adv_sub,
            'product_name' => $data->adv_sub2,
            'campaign_id' => $click->campaign_id,
            'click_id' => $click->click_id,
            'user_id' => $click->user_id
          ]);
        }
      } else {
        $status = $data->status == 'approved' ? 'Approved' : 'Rejected';

        Conversion::where('order_code', $data->conversion_id)
          ->update([
            'status' => $status
          ]);
      }

      $postback->status = 1;
      $postback->save();
    }

    return true;
  }
}
