<?php

namespace App\Http\Controllers\campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\LinkHistory;
use Illuminate\Support\Facades\Cache;
use App\Services\Campaign\CampaignService;
use App\Services\Traffic\LinkService;

class Main extends Controller
{
  const STATUS_ACTIVE = 1;

  public function index(Request $request, CampaignService $campaignService)
  {
    $campaigns = $campaignService->getAll($request);

    $categories = $campaignService->getCategories();

    return view('content.campaigns.index', compact('campaigns', 'categories'));
  }

  public function detail($id, CampaignService $campaignService, LinkService $linkService)
  {
    $campaign = $campaignService->getDetail($id);

    $linkHistories = $linkService->getHistoriesByCampagin($campaign->id);

    return view('content.campaigns.detail', compact('campaign', 'linkHistories'));
  }

  public function getCampaigns()
  {
    $campaigns = Cache::remember('campaigns_list', 600, function () {
      return Campaign::select('id', 'name')
        ->where('status', self::STATUS_ACTIVE)
        ->get();
    });

    return response()->json($campaigns, 200, []);
  }
}
