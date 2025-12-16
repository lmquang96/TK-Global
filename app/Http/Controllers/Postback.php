<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CampaignPostback;
use App\Models\Click;
use App\Models\Conversion;

class Postback extends Controller
{
    public function involve(Request $request) {
        $data = $request->all();

        CampaignPostback::create([
            'source' => 'involve',
            'data' => json_encode($data),
            'campaign_id' => self::getCampaignId($data['offer_id'])
        ]);

        return response(['status' => 'success'], 200);
    }

    public function partnerize(Request $request) {
        $data = $request->all();

        CampaignPostback::create([
            'source' => 'partnerize',
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
}
