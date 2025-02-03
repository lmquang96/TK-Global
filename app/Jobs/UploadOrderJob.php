<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;
use App\Models\Click;
use App\Models\Conversion;

class UploadOrderJob implements ShouldQueue
{
  use Queueable;

  protected $mid;
  protected $data;

  const SERVER_ID = 15;
  const DEFAULT_IP = '117.4.242.101';
  const DEFAULT_PGM_ID = '0000';
  const DEFAULT_KLOOK_AFF_ID = 'A100133640';
  const DEFAULT_ADPIA_AFF_ID = 'A100069586';
  const USD_RATE = 22500;

  /**
   * Create a new job instance.
   */
  public function __construct($mid, $data)
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
    $upsertData = $updateData = [];

    foreach ($data as $sheet) {
      if ($mid == 'tripcom') {
        $upsertData = self::getTripcomUpsertData($sheet, $mid);
  
        $updateData = $upsertData['update'] ?? [];
        $upsertData = $upsertData['insert'];
      } elseif ($mid == 'klook') {
        // ...
      }

      $chunks = array_chunk($upsertData, 500);

      try {
        foreach ($chunks as $batch) {
          Conversion::insert($batch);
        }

        foreach ($updateData as $item) {
          Conversion::query()
            ->where('campaign_id', $item['campaign_id'])
            ->where('order_time', $item['order_time'])
            ->where('order_code', $item['order_code'])
            ->where('product_code', $item['product_code'])
            ->update([
              'status' => $item['status'],
              'updated_at' => Carbon::now()
            ]);
        }

        Conversion::removeDup(
          2,
          Carbon::now()->subDays(3)->format('Y-m-d'),
          Carbon::now()->format('Y-m-d')
        );
        dd('done!');
      } catch (\Exception $e) {
        \Log::error("--------------");
        \Log::error($e->getMessage());
        \Log::error("--------------");
      }
    }

    dd($upsertData);
  }

  public function getTripcomUpsertData($sheet, $mid)
  {
    $upsertData = [];

    foreach ($sheet as $key => $row) {
      $subid = $row['tripsub1'];

      $clickData = Click::where('code', $subid)->first();

      $userId = $clickData->linkHistory->user_id;
      $clickId = $clickData->id;
      $campaginId = $clickData->linkHistory->campaign_id;

      $dataKey = 'insert';
      $time = Carbon::parse(trim($row['date_gmt8']))->subHour();
      $orderCode = trim($row['booking_id']);
      $productCode = $row['site_id'];
      $quantity = 1;

      $productType = trim($row['product_type']);
      $departureCity = trim($row['departure_city']);
      $departureCountry = trim($row['departure_country']);
      $arrivalCity = trim($row['arrival_city']);
      $arrivalCountry = trim($row['arrival_country']);
      $fromInfo = $departureCity . ", " . $departureCountry;
      $toInfo = $arrivalCity . ", " . $arrivalCountry;
      $originalSales = floatval(str_replace(",", "", substr(trim($row['amount_usd']), 1)));

      $sales = $originalSales * self::USD_RATE;
      $productName = self::getTripcomProductName($productType, $fromInfo, $toInfo);

      $sumCom = self::tripcomComissionRate($productType, $departureCountry, $arrivalCountry, $sales);
      $commissionPub = $sumCom * 0.8;
      $commissionSys = $sumCom * 0.2;
      $status = 'Pending';
      if (trim($row['booking_status']) == 'Successful') {
        $status = 'Approved';
      } elseif (trim($row['booking_status']) == 'Canceled') {
        $dataKey = 'update';
        $status = 'Cancelled';
        $sales = abs($sales);
        $commissionPub = abs($commissionPub);
        $commissionSys = abs($commissionSys);
      }

      $upsertData[$dataKey][] = [
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
        'click_id' => $clickId,
        'user_id' => $userId,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ];
    }

    return $upsertData;
  }

  public function tripcomComissionRate($type, $from, $to, $sales)
  {
    $rate = 0;

    switch ($type) {
      case 'Hotels':
        $rate = 5 / 100;
        break;

      case 'Trains':
        $rate = 2 / 100;
        break;

      case 'Flights':
        $rate = 0.5 / 100;

        if ($from == 'China' && $to == 'China') {
          $rate = 1;
          $sales = 0.6 * self::USD_RATE;
        }
        break;

      case 'Flight + Hotel':
        $rate = 2 / 100;
        break;

      case 'Tours & Tickets':
        $rate = 4 / 100;
        break;

      case 'Airport Transfers':
        $rate = 5 / 100;
        break;

      case 'Car Rentals':
        $rate = 5 / 100;
        break;

      default:
        # code...
        break;
    }

    return $sales * $rate;
  }

  public function getTripcomProductName($type, $from, $to)
  {
    $name = '';

    switch ($type) {
      case 'Hotels':
        $name = 'Hotel in ' . $from;
        break;

      case 'Trains':
        $name = 'Train from ' . $from . ' to ' . $to;
        break;

      case 'Flights':
        $name = 'Flight from ' . $from . ' to ' . $to;
        break;

      case 'Flight + Hotel':
        $name = 'Flight & Hotel from ' . $from . ' to ' . $to;
        break;

      case 'Tours & Tickets':
        $name = 'Tours & Tickets in ' . $from;
        break;

      case 'Airport Transfers':
        $name = 'Airport Transfer in ' . $from;
        break;

      case 'Car Rentals':
        $name = 'Car Rentals in ' . $from;
        break;

      default:
        # code...
        break;
    }

    return $name;
  }
}
