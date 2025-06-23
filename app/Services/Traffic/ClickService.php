<?php

namespace App\Services\Traffic;

use Illuminate\Support\Facades\Auth;
use App\Models\Click;
use Illuminate\Support\Facades\Log;

class ClickService
{
  public function getClicksGroupByCampagin($request)
  {
    $clicks = Click::query()
      ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
      ->when($request->date, function ($q, $date) {
        $dateArray = explode(" - ", $date);
        $q->whereBetween('clicks.created_at', [$dateArray[0] . ' 00:00:00', $dateArray[1] . ' 23:59:59']);
      })
      ->when($request->keyword, function ($q, $keyword) {
        return $q->join('campaigns', 'campaigns.id', '=', 'link_histories.campaign_id')
          ->where('name', 'like', '%' . $keyword . '%');
      })
      ->where('user_id', Auth::user()->id)
      ->selectRaw('campaign_id, count(*) cnt')
      ->groupBy('campaign_id');

    return $clicks;
  }

  public function getClicksCount($request)
  {
    return Click::query()
      ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
      ->when($request->date, function ($q, $date) {
        $dateArray = explode(" - ", $date);
        $q->whereBetween('clicks.created_at', [$dateArray[0] . ' 00:00:00', $dateArray[1] . ' 23:59:59']);
      })
      ->when($request->keyword, function ($q, $keyword) {
        return $q->join('campaigns', 'campaigns.id', '=', 'link_histories.campaign_id')
          ->where('name', 'like', '%' . $keyword . '%');
      })
      ->where('user_id', Auth::user()->id)
      ->count();
  }
}
