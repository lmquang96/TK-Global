<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Analytic\StatisticsService;
use App\Services\Campaign\CampaignService;

class Analytics extends Controller
{
  public function index(StatisticsService $statisticsService, CampaignService $campaignService)
  {
    $statistics = $statisticsService->getStatisticsData();

    $newCampaigns = $campaignService->getNewCampaigns();

    return view('content.dashboard.dashboards-analytics', $statistics)->with('newCampaigns', $newCampaigns);
  }

  function getDataChart(StatisticsService $statisticsService)
  {
    $data = $statisticsService->getCommissionChart();

    return response()->json([
      'status' => 200,
      'data' => $data
    ]);
  }

  function getClickChart(Request $request, StatisticsService $statisticsService)
  {
    $data = $statisticsService->getClickChart($request);

    return response()->json([
      'status' => 200,
      'data' => $data
    ]);
  }
}
