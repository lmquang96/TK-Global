<?php

namespace App\Common\Transformer;

class Performance
{
  public static function exportFormat($item, $clicks)
  {
    $clickByCampaignId = isset($clicks[$item->campaign->id]) ? $clicks[$item->campaign->id]['cnt'] : 0;

    return [
      'group' => $item->campaign->name,
      'clickCount' => $clickByCampaignId,
      'cnt' => $item->cnt,
      'total_price' => $item->total_price,
      'total_com' => $item->total_com,
      'conversion_rate' => number_format($clickByCampaignId > 0 ? ($item->cnt / $clickByCampaignId) * 100 : 0, 1, ',', '.') . '%'
    ];
  }
}
