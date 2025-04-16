<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignPostback;
use App\Models\Click;
use App\Models\Conversion;

class Postback extends Controller
{
    const USD_VND_RATE = 22500;

    public function involve(Request $request) {
        $data = $request->all();

        CampaignPostback::create([
            'source' => 'involve',
            'data' => json_encode($data),
            'campaign_id' => self::getCampaignId($data['offer_id'])
        ]);

        return response(['status' => 'success'], 200);
    }

    public function getCampaignId($adsId) {
        $campaignId = '';

        switch ($adsId) {
            case 'value':
                # code...
                break;
            
            default:
                $campaignId = 3;
                break;
        }
        return $campaignId;
    }

    public function scan() {
        $postbackList = CampaignPostback::where('status', 0)->get();

        $data = json_decode($postback->data);

        foreach ($postbackList as $key => $postback) {

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

        dd('done!');
    }
}
