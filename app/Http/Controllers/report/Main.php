<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Conversion\ConversionService;
use App\Services\Traffic\ClickService;

class Main extends Controller
{
  const DEFAULT_SUB_DAYS = 30;

  public function performance(Request $request, ConversionService $conversionService, ClickService $clickService)
  {
    if (!$request->date) {
      $request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d') . " - " . Carbon::now()->format('Y-m-d')]);
    }

    $conversionsData = $conversionService->getConversionsGroupByCampagin($request);

    $clicksData = $clickService->getClicksGroupByCampagin($request);

    $data = array_merge($conversionsData, $clicksData);

    return view('content.report.performance', $data);
  }

  public function order(Request $request, ConversionService $conversionService, ClickService $clickService)
  {
    if (!$request->date) {
      $request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d') . " - " . Carbon::now()->format('Y-m-d')]);
    }

    $data = $conversionService->getConversions($request);

    $clickCount = $clickService->getClicksCount($request);

    return view('content.report.order', $data)->with('clickCount', $clickCount);
  }
}
