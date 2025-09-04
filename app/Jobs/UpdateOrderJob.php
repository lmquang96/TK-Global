<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;
use App\Models\Conversion;
use App\Models\Click;

class UpdateOrderJob implements ShouldQueue
{
  use Queueable;

  protected $mid;
  protected $data;

  const USD_RATE = 22500;
  const KLOOK_ID = 1;

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
      if ($mid == 'klook') {
        $updateData = self::getKlookUpdateData($sheet, $mid);
      } else if ($mid == 'tripcom') {
        $data = self::getTripcomUpdateData($sheet, $mid);
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
              'updated_at' => Carbon::now()
            ]);
        }

        // Conversion::insert($insertData);

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

    foreach ($sheet as $row) {
      if (in_array($row['ticket_status'], ['Full Refund'])) {
        continue;
      }
      $pubRate = 0.7;
      $sysRate = 0.3;
      $campaginId = self::KLOOK_ID;
      if ($mid == 'klookhk') {
        $pubRate = 0.8;
        $sysRate = 0.2;
        $campaginId = 32;
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

      $updateData[] = [
        'order_code' => $orderCode,
        'order_time' => $time,
        'unit_price' => $sales,
        'commission_pub' => $commissionPub,
        'commission_sys' => $commissionSys,
        'product_code' => $productCode,
        'campaign_id' => $campaginId,
        'comment' => 'payment t8'
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
      // if ($row['commission_date'] != '2025-03' && $row['commission_date'] != '2025-02') {
      //   continue;
      // }
      $subid = $row['tripsub1'];
      // $subid = 'd1106aded1763c2a2c67170857227d1613b620a8';

      $clickData = Click::where('code', $subid)->first();

      if (empty($clickData)) {
        $subid = 'd1106aded1763c2a2c67170857227d1613b620a8';
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
        'updated_at' => Carbon::now()
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
