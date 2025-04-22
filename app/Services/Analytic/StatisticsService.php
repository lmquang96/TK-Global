<?php

namespace App\Services\Analytic;

use App\Models\Click;
use App\Models\Conversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class StatisticsService
{

  const DEFAULT_SUB_DAYS = 6;
  const DEFAULT_CACHE_TIME = 600;

  public function getStatisticsData()
  {
    $userId = Auth::user()->id;
    $subDays = self::DEFAULT_SUB_DAYS;
    $eDate = Carbon::now()->format('Y-m-d');
    $sDate = Carbon::now()->subDays($subDays)->format('Y-m-d');
    $eDateChange = Carbon::now()->subDays($subDays + 1)->format('Y-m-d');
    $sDateChange = Carbon::now()->subDays(2 * $subDays + 1)->format('Y-m-d');

    $statistics = Cache::remember('statistics_' . $userId, 600, function () use ($sDate, $eDate) {
      return $this->getStatistics($sDate, $eDate);
    });
    $statisticsChange = Cache::remember('statistics_change_' . $userId, 600, function () use ($sDateChange, $eDateChange) {
      return $this->getStatistics($sDateChange, $eDateChange);
    });

    $results = [];

    $results['totalCom'] = $statistics['totalCom'];
    $results['totalSales'] = $statistics['totalSales'];
    $results['clickCount'] = $statistics['clickCount'];
    $results['totalConversion'] = $statistics['totalConversion'];

    $results['totalComChange'] = $statisticsChange['totalCom'] > 0 ? ($statistics['totalCom'] / $statisticsChange['totalCom'] * 100) - 100 : 100;
    $results['totalSalesChange'] = $statisticsChange['totalSales'] > 0 ? ($statistics['totalSales'] / $statisticsChange['totalSales'] * 100) - 100 : 100;
    $results['clickCountChange'] = $statisticsChange['clickCount'] > 0 ? ($statistics['clickCount'] / $statisticsChange['clickCount'] * 100) - 100 : 100;
    $results['totalConversionChange'] = $statisticsChange['totalConversion'] > 0 ? ($statistics['totalConversion'] / $statisticsChange['totalConversion'] * 100) - 100 : 100;

    return $results;
  }

  private function getStatistics($sDate, $eDate)
  {
    $userId = Auth::user()->id;

    $query = Conversion::where('user_id', $userId)
      ->whereBetween('order_time', [$sDate . ' 00:00:00', $eDate . ' 23:59:59']);

    $totalCom = $query->sum('commission_pub');
    $totalSales = $query->selectRaw('sum(unit_price * quantity) as sales')->pluck('sales')->first();

    $totalConversion = $query->count();

    $clickCount = Click::query()
      ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
      ->whereBetween('clicks.created_at', [$sDate . ' 00:00:00', $eDate . ' 23:59:59'])
      ->where('user_id', $userId)
      ->selectRaw('count(*) cnt')
      ->pluck('cnt')->first();

    return [
      'totalCom' => $totalCom,
      'totalSales' => $totalSales ?? 0,
      'clickCount' => $clickCount,
      'totalConversion' => $totalConversion
    ];
  }

  function getCommissionChart()
  {
    $userId = Auth::user()->id;
    $subDays = self::DEFAULT_SUB_DAYS;
    $eDate = Carbon::now()->format('Y-m-d');
    $sDate = Carbon::now()->subDays($subDays)->format('Y-m-d');

    return Cache::remember('chart_data_' . $userId, 600, function () use ($userId, $sDate, $eDate) {
      $query = Conversion::where('user_id', $userId)
        ->whereBetween('order_time', [$sDate . ' 00:00:00', $eDate . ' 23:59:59'])
        ->selectRaw("DATE_FORMAT(order_time, '%Y-%m-%d') as time, sum(commission_pub) as sumcom")
        ->groupBy('time')
        ->pluck('sumcom', 'time');

      $dates = collect();
      for ($i = 6; $i >= 0; $i--) {
        $dates->put(Carbon::today()->subDays($i)->toDateString(), 0);
      }

      $result = $dates->merge($query)->toArray();

      $result = array_map('floatval', $result);

      return $result;
    });
  }

  function getClickChart($request)
  {
    $userId = Auth::user()->id;
    $subDays = self::DEFAULT_SUB_DAYS;
    $eDate = Carbon::now()->format('Y-m-d');
    $sDate = Carbon::now()->subDays($subDays)->format('Y-m-d');
    if ($request->sDate) {
      $sDate = $request->sDate;
    }

    if ($request->eDate) {
      $eDate = $request->eDate;
    }

    $query = Click::query()
      ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
      ->whereBetween('clicks.created_at', [$sDate . ' 00:00:00', $eDate . ' 23:59:59'])
      ->where('user_id', $userId)
      ->selectRaw("DATE_FORMAT(clicks.created_at, '%Y-%m-%d') as time, count(clicks.id) as cnt")
      ->groupBy('time')
      ->pluck('cnt', 'time');

    $dates = collect();
    for ($i = Carbon::parse($sDate); $i->lte(Carbon::parse($eDate)); $i->addDay()) {
      $dates->put($i->toDateString(), 0);
    }

    $result = $dates->merge($query)->toArray();

    $result = array_map('intval', $result);

    return $result;
  }
}
