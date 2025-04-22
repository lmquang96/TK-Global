<?php

namespace App\Services\Campaign;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CampaignService
{

  public function getNewCampaigns()
  {
    return Cache::remember('new_campaigns', 600, function () {
      return Campaign::statusActive()->orderBy('created_at', 'desc')->limit(5)->offset(0)->get();
    });
  }

  public function getAll($request)
  {
    return Cache::remember('campaigns_all', 600, function () use ($request) {
      return Campaign::statusActive()
        ->when($request->keyword, function ($q, $keyword) {
          $q->where('name', 'like', '%' . $keyword . '%');
        })
        ->when($request->category, function ($q, $category) {
          $q->where('category_id', $category);
        })
        ->when($request->cp_type, function ($q, $cpType) {
          $q->where('cp_type', $cpType);
        })
        ->get();
    });
  }

  public function getCategories()
  {
    return Category::statusActive()->get();
  }

  public function getDetail($id)
  {
    return Campaign::statusActive()
      ->where('code', $id)
      ->first();
  }
}
