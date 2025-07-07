<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;
use App\Models\Conversion;

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
      }

      try {
        foreach ($updateData as $item) {
          Conversion::query()
            ->where('campaign_id', $item['campaign_id'])
            ->where('order_time', $item['order_time'])
            ->where('order_code', $item['order_code'])
            ->where('product_code', $item['product_code'])
            ->update([
              'unit_price' => $item['unit_price'],
              'commission_pub' => $item['commission_pub'],
              'commission_sys' => $item['commission_sys'],
              'updated_at' => Carbon::now()
            ]);
        }

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
      if (in_array($row['ticket_status'], ['Full Refund', 'Confirmed'])) {
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
        'campaign_id' => $campaginId
      ];
    }

    return $updateData;
  }
}
