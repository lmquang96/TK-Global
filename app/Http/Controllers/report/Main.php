<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Conversion\ConversionService;
use App\Services\Traffic\ClickService;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportOrderExport;
use App\Exports\ReportPerformanceExport;

class Main extends Controller
{
  const DEFAULT_SUB_DAYS = 30;
  const PER_PAGE = 25;

  public function performance(Request $request, ConversionService $conversionService, ClickService $clickService)
  {
    if (!$request->date) {
      $request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d') . " - " . Carbon::now()->format('Y-m-d')]);
    }

    $conversionsData = [];

    $conversionsDataBuilder = $conversionService->getConversionsGroupByCampagin($request);

    $conversionsData['totalConversion'] = $conversionsDataBuilder->get()->sum(function ($item) {
      return $item->cnt;
    });

    $conversionsData['totalPrice'] = $conversionsDataBuilder->get()->sum(function ($item) {
      return $item->total_price;
    });

    $conversionsData['totalCom'] = $conversionsDataBuilder->get()->sum(function ($item) {
      return $item->total_com;
    });

    $conversionsData['data'] = $conversionsDataBuilder->paginate(self::PER_PAGE)->withQueryString();

    $clicksData = [];

    $clicksDataBuilder = $clickService->getClicksGroupByCampagin($request);

    $clicksData['clickCount'] = $clicksDataBuilder->get()->sum(function ($item) {
      return $item->cnt;
    });

    $clicks = $clicksDataBuilder->get();

    $clicksData['clicks'] = $clicks->keyBy('campaign_id')->toArray();

    $data = array_merge($conversionsData, $clicksData);

    return view('content.report.performance', $data);
  }

  public function order(Request $request, ConversionService $conversionService, ClickService $clickService)
  {
    if (!$request->date) {
      $request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d') . " - " . Carbon::now()->format('Y-m-d')]);
    }

    $result = [];

    $data = $conversionService->getConversions($request);

    $result['totalConversion'] = $data->count();

    $result['totalPrice'] = $data->get()->sum(function ($item) {
      return $item->quantity * $item->unit_price;
    });

    $result['totalCom'] = $data->get()->sum(function ($item) {
      return $item->quantity * $item->commission_pub;
    });

    $result['data'] = $data->orderBy('order_time', 'desc')->paginate(self::PER_PAGE)->withQueryString();

    $clickCount = $clickService->getClicksCount($request);

    return view('content.report.order', $result)->with('clickCount', $clickCount);
  }

  public function exportReportOrder(Request $request)
  {
    return Excel::download(new ReportOrderExport($request, app(ConversionService::class)), 'tk-report-order-' . Carbon::now()->format('YmdHis') . '-' . time() . '.xlsx');
  }

  public function exportReportPerformance(Request $request)
  {
    return Excel::download(new ReportPerformanceExport($request, app(ConversionService::class), app(ClickService::class)), 'tk-report-order-' . Carbon::now()->format('YmdHis') . '-' . time() . '.xlsx');
  }
}
