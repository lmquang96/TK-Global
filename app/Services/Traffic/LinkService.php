<?php

namespace App\Services\Traffic;

use Illuminate\Support\Facades\Auth;
use App\Models\LinkHistory;
use Illuminate\Support\Facades\Log;

class LinkService
{
  const PER_PAGE = 25;

  public function getHistoriesByCampagin($campaignId)
  {
    return LinkHistory::where('user_id', Auth::user()->id)
      ->where('campaign_id', $campaignId)
      ->limit(5)
      ->get();
  }

  public function storeHistory($request)
  {
    $linkHistory = new LinkHistory;

    $linkHistory->code = sha1(time());
    $linkHistory->original_url = $request->originalLink;
    $linkHistory->domain = $request->domain;
    $linkHistory->short_url = null;
    $linkHistory->sub1 = $request->sub1;
    $linkHistory->sub2 = $request->sub2;
    $linkHistory->sub3 = $request->sub3;
    $linkHistory->sub4 = $request->sub4;
    $linkHistory->user_id = Auth::user()->id;
    $linkHistory->campaign_id = $request->campaignId;

    try {
      $linkHistory->save();

      return [
        'status' => true,
        'data' => $linkHistory->code
      ];
    } catch (\Throwable $th) {
      Log::error('Lỗi xảy ra khi lưu lịch sử tạo link: ' . $th->getMessage());

      return [
        'status' => false,
        'data' => $th->getMessage()
      ];
    }
  }

  public function getHistories($request)
  {
    $perPage = self::PER_PAGE;

    return LinkHistory::where('user_id', Auth::user()->id)
      ->when($request->keyword, function ($q, $keyword) {
        return $q->whereHas('campaign', function ($query) use ($keyword) {
          $query->where('name', 'like', '%' . $keyword . '%');
        });
      })
      ->when($request->date, function ($q, $date) {
        $dateArray = explode(" - ", $date);
        $q->whereBetween('created_at', [$dateArray[0] . ' 00:00:00', $dateArray[1] . ' 23:59:59']);
      })
      ->paginate($perPage);
  }
}
