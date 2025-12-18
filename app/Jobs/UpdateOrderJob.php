<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;
use App\Models\Conversion;
use App\Models\Click;
use App\Models\LinkHistory;
use App\Models\User;

class UpdateOrderJob implements ShouldQueue
{
  use Queueable;

  protected $mid;
  protected $data;

  const USD_RATE = 22500;
  const MYR_RATE = 5962.5;
  const KLOOK_ID = 1;
  const KLOOKHK_ID = 32;

  /**
   * Create a new job instance.
   */
  public function __construct(string $mid, array $data)
  {
    $this->mid = $mid;
    $this->data = $data;
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {
    $mid = $this->mid;
    $data = $this->data;

    foreach ($data as $sheet) {
      if ($mid == 'klook' || $mid == 'klookhk') {
        $insertData = [];
        $updateData = self::getKlookUpdateData($sheet, $mid);
      } else if ($mid == 'tripcom') {
        $data = self::getTripcomUpdateData($sheet, $mid);
        $insertData = $data['insert'] ?? [];
        $updateData = $data['update'] ?? [];
      } else if ($mid == 'tripcomnetwork' || $mid == 'traveloka') {
        $data = self::getInvolveUpdateData($sheet, $mid);
        $insertData = $data['insert'] ?? [];
        $updateData = $data['update'] ?? [];
      }

      try {
        foreach ($updateData as $item) {
          // Conversion::upsert(
          //   [
          //     $item
          //   ],
          //   [
          //     'campaign_id',
          //     'order_code',
          //     'product_code',
          //   ],
          //   [
          //     'unit_price',
          //     'quantity',
          //     'commission_pub',
          //     'commission_sys',
          //     'comment',
          //     'updated_at',
          //   ]
          // );

          Conversion::query()
            ->where('campaign_id', $item['campaign_id'])
            ->where('order_code', $item['order_code'])
            ->where('product_code', $item['product_code'])
            ->update([
              'unit_price' => $item['unit_price'],
              'commission_pub' => $item['commission_pub'],
              'commission_sys' => $item['commission_sys'],
              'comment' => $item['comment'],
              'updated_at' => Carbon::now()
            ]);
        }

        Conversion::insert($insertData);

        dd('done!');
      } catch (\Exception $e) {
        \Log::error("--------------");
        \Log::error($e->getMessage());
        \Log::error("--------------");
      }
    }
  }

  public static function getKlookUpdateData($sheet, $mid)
  {
    $updateData = [];

    foreach ($sheet as $key => $row) {
      if (in_array($row['ticket_status'], ['Full Refund'])) {
        continue;
      }
      $pubRate = 0.7;
      $sysRate = 0.3;
      $campaginId = self::KLOOK_ID;
      if ($mid == 'klookhk') {
        $pubRate = 0.8;
        $sysRate = 0.2;
        $campaginId = self::KLOOKHK_ID;
      }
      $time = Carbon::parse(trim($row['book_date']) . ' ' . trim($row['book_time']));
      $orderCode = trim($row['order_id']);
      $productCode = trim($row['ticket_id']) . "_" . trim($row['booking_number']);
      $sales = $row['commissionable_sales_amountusd'] * self::USD_RATE;
      $comAmount = trim($row['payable_commission_amt']);
      $comObject = explode(" ", $comAmount);
      if (count($comObject) == 2) {
        $sumCom = floatval($comObject[1]) * self::USD_RATE;
      } else {
        continue;
      }
      $commissionPub = $sumCom * $pubRate;
      $commissionSys = $sumCom * $sysRate;

      $status = 'Pending';
      $quantity = 1;
      $productName = str_replace("'", "''", trim($row['activity_name']));

      $adid = ($row['adid'] && strlen($row['adid']) >= 6 && isset($ads[$row['adid']])) ? $ads[$row['adid']] : '';

      if (!empty($adid)) {
        $subid = $adid['sub1'];
        $affiliate_id = 'TK20250031';
        if (!empty($subid) && strlen($subid) == 10) {
          $affiliate_id = $subid;
        }
        $sub1 = $ads[$row['adid']]['sub2'];
        $sub2 = $ads[$row['adid']]['sub3'];
      } else {
        // continue;
        $affiliate_id = 'TK20250031';
        $sub1 = $sub2 = null;
      }

      $userId = User::query()
        ->whereHas('profile', function ($query) use ($affiliate_id) {
          $query->where('affiliate_id', $affiliate_id);
        })
        ->pluck('id')->first();
      $linkHistoryId = null;

      $existLink = LinkHistory::where('sub1', $sub1)
        ->where('sub2', $sub2)
        ->where('user_id', $userId)
        ->where('campaign_id', $campaginId)
        ->first();

      if (!$existLink) {
        $link = new LinkHistory();
        $link->code = sha1(time() + $key);
        $link->sub1 = $sub1;
        $link->sub2 = $sub2;
        $link->user_id = $userId;
        $link->campaign_id = $campaginId;

        try {
          $link->save();
          $linkHistoryId = $link->id;
        } catch (\Exception $e) {
          \Log::error("--------------");
          \Log::error($e->getMessage());
          \Log::error("--------------");
        }
      } else {
        $linkHistoryId = $existLink->id;
      }

      $clickId = null;
      $click = new Click();

      $click->code = sha1(time() + $key);
      $click->link_history_id = $linkHistoryId;

      try {
        $click->save();
        $clickId = $click->id;
      } catch (\Exception $e) {
        \Log::error("--------------");
        \Log::error($e->getMessage());
        \Log::error("--------------");
      }

      if (in_array($row['ticket_status'], ['Full Refund'])) {
        $orderCode .= '_refunded';
        if ($commissionPub == 0) {
          continue;
        }
      }

      $updateData[] = [
        'code' => sha1(time() + $key),
        'order_code' => $orderCode,
        'order_time' => $time,
        'unit_price' => $sales,
        'quantity' => $quantity,
        'commission_pub' => $commissionPub,
        'commission_sys' => $commissionSys,
        'status' => $status,
        'product_code' => $productCode,
        'product_name' => $productName,
        'campaign_id' => $campaginId,
        'comment' => 'payment 202512-2',
        'click_id' => $clickId,
        'user_id' => $userId,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    }

    return $updateData;
  }

  public static function getTripcomUpdateData($sheet, $mid)
  {
    $upsertData = [];
    $pubRate = 0.7;
    $sysRate = 0.3;

    foreach ($sheet as $key => $row) {
      if ($row['commission_date'] != '2025-09' && $row['commission_date'] != '2025-10') {
        continue;
      }
      $subid = $row['tripsub1'];
      // $subid = 'd1106aded1763c2a2c67170857227d1613b620a8';

      $clickData = Click::where('code', $subid)->first();

      if (empty($clickData)) {
        $subid = '1152fd54f6c4da01aefe879b2477642a83b2ab12';
        $clickData = Click::where('code', $subid)->first();
      }

      $userId = $clickData->linkHistory->user_id;
      $clickId = $clickData->id;
      $campaginId = $clickData->linkHistory->campaign_id;

      if ($campaginId == 31) {
        $pubRate = 0.8;
        $sysRate = 0.2;
      }

      $arrayKey = 'update';

      $time = Carbon::parse(trim($row['date_gmt8']));
      $orderCode = trim($row['booking_id']);
      $productCode = $row['site_id'];
      $quantity = 1;

      $originalSales = self::convertUSD(trim($row['booking_amount']));

      $sales = $originalSales * self::USD_RATE;
      $productName = trim($row['prod_sub_type']);
      $sumCom = self::convertUSD(trim($row['commission_amount']));

      if ($sumCom < 0) {
        $arrayKey = 'insert';
      }

      $commissionPub = $sumCom * self::USD_RATE * $pubRate;
      $commissionSys = $sumCom * self::USD_RATE * $sysRate;
      $status = 'Pending';

      $upsertData[$arrayKey][] = [
        'code' => sha1(time() + $key),
        'order_code' => $orderCode . ($arrayKey == 'insert' ? '_refunded' : ''),
        'order_time' => $time,
        'unit_price' => $sales,
        'quantity' => $quantity,
        'commission_pub' => $commissionPub,
        'commission_sys' => $commissionSys,
        'status' => $status,
        'product_code' => $productCode,
        'product_name' => $productName,
        'campaign_id' => $campaginId,
        'click_id' => $clickId,
        'user_id' => $userId,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'comment' => 'payment 202512-3'
      ];
    }

    return $upsertData;
  }

  public static function getInvolveUpdateData($sheet, $mid)
  {
    $upsertData = [];
    $pubRate = 0.7;
    $sysRate = 0.3;

    foreach ($sheet as $key => $row) {
      // dd($row);
      // if ($row['commission_date'] != '2025-03' && $row['commission_date'] != '2025-02') {
      //   continue;
      // }
      $subid = $row['publisher_sub_id_1'];

      if ($subid == 'TK20250011') {
        $subid = '34db1ecd9e8d3d2008fd48be54232a9b991291ed';
      }

      $clickData = Click::where('code', $subid)->first();

      if (empty($clickData)) {
        $subid = '21231099928e0f5f4ed9c1965fb3798feebe6791';
        $clickData = Click::where('code', $subid)->first();
      }

      $userId = $clickData->linkHistory->user_id;
      $clickId = $clickData->id;
      $campaginId = $clickData->linkHistory->campaign_id;

      $arrayKey = 'update';

      $time = Carbon::parse(trim($row['conversion_date']));
      $orderCode = trim($row['conversion_id']);
      $productCode = $row['order_id'];
      $quantity = 1;

      $originalSales = $row['sale_amount_myr'];
      if (gettype($originalSales) == 'string')
      {
        $originalSales = str_replace(',', '', $originalSales);
        $originalSales = floatval($originalSales);
      }

      $sales = $originalSales * self::MYR_RATE;
      $productName = '';
      $sumCom = $row['est_earning_usd'];

      // if ($sumCom < 0) {
      //   $arrayKey = 'insert';
      // }

      // $arrayKey = 'insert';

      $commissionPub = $sumCom * self::USD_RATE * $pubRate;
      $commissionSys = $sumCom * self::USD_RATE * $sysRate;
      $status = 'Pending';

      $upsertData[$arrayKey][] = [
        'code' => sha1(time() + $key),
        'order_code' => $orderCode,
        'order_code' => $orderCode,
        'order_time' => $time,
        'unit_price' => $sales,
        'quantity' => $quantity,
        'commission_pub' => $commissionPub,
        'commission_sys' => $commissionSys,
        'status' => $status,
        'product_code' => $productCode,
        'product_name' => $productName,
        'campaign_id' => $campaginId,
        'click_id' => $clickId,
        'user_id' => $userId,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'comment' => 'payment 202512-1'
      ];
    }

    return $upsertData;
  }

  public static function convertUSD($usdString)
  {
    $usdObject = explode("-", $usdString);

    if (count($usdObject) == 2) {
      $usdObject2 = explode("$", $usdObject[1]);
      return 0 - floatval(str_replace(",", "", $usdObject2[1]));
    } else {
      $usdObject2 = explode("$", $usdObject[0]);
      return floatval($usdObject2[1]);
    }
  }
}
