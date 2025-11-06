<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Carbon\Carbon;
use App\Models\Click;
use App\Models\Conversion;
use App\Models\Config;
use App\Models\User;
use App\Models\LinkHistory;

class UploadOrderJob implements ShouldQueue
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
  public function handle()
  {
    $mid = $this->mid;
    $data = $this->data;
    $upsertData = $updateData = [];
    $cid = 1;

    foreach ($data as $sheet) {
      if (in_array($mid, ['tripcom', 'tripcomhk', 'tripcomnew'])) {

        $upsertData = self::getTripcomUpsertData($sheet);

        $updateData = $upsertData['update'] ?? [];
        $upsertData = $upsertData['insert'];
        $cid = 2;
      } elseif ($mid == 'klook') {

        $ads = Config::query()
          ->where('name', 'klook_ads')
          ->pluck('value')
          ->first();
        if (empty($ads)) {
          return true;
        }

        $ads = json_decode($ads, true);

        $upsertData = self::getKlookUpsertData($sheet, $mid, $ads);

        $updateData = $upsertData['update'] ?? [];
        $upsertData = $upsertData['insert'];
      } elseif ($mid == 'klookhk') {

        $ads = Config::query()
          ->where('name', 'klookhk_ads')
          ->pluck('value')
          ->first();
        if (empty($ads)) {
          return true;
        }

        $ads = json_decode($ads, true);

        $upsertData = self::getKlookUpsertData($sheet, $mid, $ads);

        $updateData = $upsertData['update'] ?? [];
        $upsertData = $upsertData['insert'];
      } elseif ($mid == 'kkday') {
        $cid = 16;
        $upsertData = self::getKkdayUpsertData($sheet, $mid);

        $updateData = $upsertData['update'] ?? [];
        $upsertData = $upsertData['insert'];
      }

      $chunks = array_chunk($upsertData, 500);

      try {
        foreach ($chunks as $batch) {
          Conversion::insertOrIgnore($batch);
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
          $cid,
          Carbon::now()->subDays(120)->format('Y-m-d'),
          Carbon::now()->format('Y-m-d')
        );
        dd('done!');
      } catch (\Exception $e) {
        \Log::error("--------------");
        \Log::error($e->getMessage());
        \Log::error("--------------");
      }
    }
  }

  public function getTripcomUpsertData($sheet)
  {
    $upsertData = [];
    $pubRate = 0.7;
    $sysRate = 0.3;

    foreach ($sheet as $key => $row) {
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
      // $originalSales = floatval(str_replace(",", ".", substr(trim($row['amount']), 1)));
      $originalSales = floatval(str_replace(",", ".", trim($row['amount'])));

      $sales = $originalSales * self::USD_RATE;
      $productName = self::getTripcomProductName($productType, $fromInfo, $toInfo);

      $sumCom = self::tripcomComissionRate($productType, $departureCountry, $arrivalCountry, $sales);
      $commissionPub = $sumCom * $pubRate;
      $commissionSys = $sumCom * $sysRate;
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

  public function getKlookUpsertData($sheet, $mid, $ads)
  {
    $upsertData = [];
    $pubRate = 0.7;
    $sysRate = 0.3;

    foreach ($sheet as $key => $row) {
      $adid = ($row['adid'] && strlen($row['adid']) >= 6 && isset($ads[$row['adid']])) ? $ads[$row['adid']] : '';

      if (!empty($adid)) {
        $subid = $adid['sub1'];
        $affiliate_id = 'KT20250005';
        if (!empty($subid) && strlen($subid) == 10) {
          $affiliate_id = $subid;
        }
        $sub1 = $ads[$row['adid']]['sub2'];
        $sub2 = $ads[$row['adid']]['sub3'];
      } else {
        // continue;
        $affiliate_id = 'TK20250012';
        $sub1 = $sub2 = null;
      }

      $userId = User::query()
        ->whereHas('profile', function ($query) use ($affiliate_id) {
          $query->where('affiliate_id', $affiliate_id);
        })
        ->pluck('id')->first();
      $campaginId = self::KLOOK_ID;
      $linkHistoryId = null;

      if ($mid == 'klookhk') {
        $pubRate = 0.8;
        $sysRate = 0.2;
        $campaginId = 32;
      }

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

      $dataKey = 'insert';
      $time = Carbon::parse(trim($row['action_date']) . ' ' . trim($row['action_time']));
      $orderCode = trim($row['order_id']);
      $productCode = trim($row['ticket_id']) . "_" . trim($row['booking_number']);
      $quantity = 1;

      $sales = 0;
      $salesAmount = trim($row['sales_amount']);
      $salesObject = explode(" ", $salesAmount);

      if (count($salesObject) == 2) {
        $sales = self::convertCurrency($salesObject);
      } else {
        continue;
      }
      $productName = str_replace("'", "''", trim($row['activity_name']));
      $sumCom = 0;
      $comAmount = trim($row['commission_amount']);
      $comObject = explode(" ", $comAmount);
      if (count($comObject) == 2) {
        $sumCom = self::convertCurrency($comObject);
      } else {
        continue;
      }
      $commissionPub = $sumCom * $pubRate;
      $commissionSys = $sumCom * $sysRate;
      $status = 'Pending';
      // if ($row['action'] == 'Refund') {
      //   $dataKey = 'update';
      //   $status = 'Cancelled';
      //   $sales = abs($sales);
      //   $commissionPub = abs($commissionPub);
      //   $commissionSys = abs($commissionSys);
      // }

      $upsertData[$dataKey][] = [
        'code' => sha1(time() + $key),
        'order_code' => $orderCode."_refunded",
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

  public function convertCurrency($currency)
  {
    $rate = 0;

    switch ($currency[0]) {
      case 'TWD':
        $rate = 742.5;
        break;

      case 'HKD':
        $rate = 3000;
        break;

      case 'USD':
        $rate = 22500;
        break;

      case 'CAD':
        $rate = 16200;
        break;

      case 'PHP':
        $rate = 393.75;
        break;

      case 'CNY':
        $rate = 3105;
        break;

      case 'MYR':
        $rate = 5962.5;
        break;

      case 'AUD':
        $rate = 14175;
        break;

      case 'EUR':
        $rate = 25200;
        break;

      case 'JPY':
        $rate = 148.5;
        break;

      case 'GBP':
        $rate = 29250;
        break;

      case 'NZD':
        $rate = 13050;
        break;

      case 'IDR':
        $rate = 1.3725;
        break;

      case 'INR':
        $rate = 261;
        break;

      case 'SGD':
        $rate = 17100;
        break;

      case 'KRW':
        $rate = 15.75;
        break;

      case 'TRY':
        $rate = 569.25;
        break;

      case 'SEK':
        $rate = 2250;
        break;

      case 'ILS':
        $rate = 6075;
        break;

      case 'AED':
        $rate = 6124.5;
        break;

      case 'CHF':
        $rate = 27000;
        break;

      case 'MXN':
        $rate = 1147.5;
        break;

      case 'THB':
        $rate = 675;
        break;

      case 'ZAR':
        $rate = 1215;
        break;

      case 'NOK':
        $rate = 2137.5;
        break;

      case 'VND':
        $rate = 1;
        break;

      default:
        $rate = -1;
        break;
    }

    return floatval($currency[1] * $rate);
  }

  public function getKkdayUpsertData($sheet)
  {
    $upsertData = [];
    $pubRate = 0.7;
    $sysRate = 0.3;

    foreach ($sheet as $key => $row) {
      $subid = $row['sourceparam2'];

      if (empty($subid)) {
        continue;
      }
      // $subid = 'd1106aded1763c2a2c67170857227d1613b620a8';

      $clickData = Click::where('code', $subid)->first();

      if (empty($clickData)) {
        // $subid = 'd1106aded1763c2a2c67170857227d1613b620a8';
        // $clickData = Click::where('code', $subid)->first();
        continue;
      }

      $userId = $clickData->linkHistory->user_id;
      $clickId = $clickData->id;
      $campaginId = $clickData->linkHistory->campaign_id;

      $dataKey = 'insert';
      $time = Carbon::parse(trim($row['crtdt']))->addHours(7);
      $orderCode = trim($row['ordermid']);
      $productCode = $row['prodoid'];
      $quantity = 1;

      $originalSales = floatval(str_replace(",", ".", trim($row['pricetotal'])));

      $sales = $originalSales * self::USD_RATE;
      $productName = trim($row['prodname']);

      $sumCom = floatval(str_replace(",", ".", trim($row['commission'])));
      $commissionPub = $sumCom * self::USD_RATE * $pubRate;
      $commissionSys = $sumCom * self::USD_RATE * $sysRate;
      $status = 'Pending';
      if (trim($row['orderstatus']) == 'BACK') {
        $status = 'Approved';
      } elseif (trim($row['orderstatus']) == 'CX') {
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
}
