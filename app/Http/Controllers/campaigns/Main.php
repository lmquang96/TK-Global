<?php

namespace App\Http\Controllers\campaigns;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\LinkHistory;
use Illuminate\Support\Facades\Cache;

class Main extends Controller
{
  const STATUS_ACTIVE = 1;

  public function index(Request $request)
  {
    $campaigns = Cache::remember('campaigns_all', 600, function() use ($request) {
      return Campaign::where('status', self::STATUS_ACTIVE)
      ->when($request->keyword, function($q, $keyword) {
        $q->where('name', 'like', '%'.$keyword.'%');
      })
      ->when($request->category, function($q, $category) {
        $q->where('category_id', $category);
      })
      ->when($request->cp_type, function($q, $cpType) {
        $q->where('cp_type', $cpType);
      })
      ->get();
    });

    $categories = Category::where('status', self::STATUS_ACTIVE)->get();

    return view('content.campaigns.index', compact('campaigns', 'categories'));
  }

  public function detail($id)
  {
    $campaign = Campaign::where('status', self::STATUS_ACTIVE)
    ->where('code', $id)
    ->first();

    $linkHistories = LinkHistory::where('user_id', auth()->user()->id)
    ->where('campaign_id', $campaign->id)
    ->limit(5)
    ->get();

    return view('content.campaigns.detail', compact('campaign', 'linkHistories'));
  }

  public function getCampaigns()
  {
    $campaigns = Cache::remember('campaigns_list', 600, function() {
      return Campaign::select('id', 'name')
      ->where('status', self::STATUS_ACTIVE)
      ->get();
    });

    return response()->json($campaigns, 200, []);
  }
}
