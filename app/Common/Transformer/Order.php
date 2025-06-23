<?php

namespace App\Common\Transformer;

class Order
{
  public static function exportFormat($item)
  {
    return [
      'code' => $item->code,
      'order_time' => $item->order_time,
      'click_time' => $item->click->created_at,
      'campaign' => $item->campaign->name,
      'order_code' => $item->order_code,
      'unit_price' => $item->unit_price,
      'commission_pub' => $item->commission_pub,
      'status' => $item->status == 'Pending' ? 'Tạm duyệt' : ($item->status == 'Approved' ? 'Đã duyệt' : 'Đã hủy'),
      'sub1' => $item->click->linkHistory->sub1 ?? 'N/A',
      'sub2' => $item->click->linkHistory->sub2 ?? 'N/A',
      'sub3' => $item->click->linkHistory->sub3 ?? 'N/A',
      'sub4' => $item->click->linkHistory->sub4 ?? 'N/A',
    ];
  }
}
