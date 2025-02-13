<?php

namespace App\Http\Controllers\links;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkHistory;

class Main extends Controller
{
    const PER_PAGE = 25;
    public function storeHistory(Request $request) {
        $linkHistory = new LinkHistory;

        $linkHistory->code = sha1(time());
        $linkHistory->original_url = $request->originalLink;
        $linkHistory->domain = $request->domain;
        $linkHistory->short_url = null;
        $linkHistory->sub1 = $request->sub1;
        $linkHistory->sub2 = $request->sub2;
        $linkHistory->sub3 = $request->sub3;
        $linkHistory->sub4 = $request->sub4;
        $linkHistory->user_id = auth()->user()->id;
        $linkHistory->campaign_id = $request->campaignId;

        try {
            $linkHistory->save();

            return response()->json(['message' => 'success!', 'data' => $linkHistory->code], 200, []);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return response()->json(['error', $e->getMessage()], 200, []);
        }
    }

  public function history(Request $request) {
    $perPage = self::PER_PAGE;

    $linkHistories = LinkHistory::where('user_id', auth()->user()->id)
    ->when($request->keyword, function($q, $keyword) {
      return $q->whereHas('campaign', function ($query) use ($keyword) {
        $query->where('name', 'like', '%'.$keyword.'%');
      });
    })
    ->when($request->date, function($q, $date) {
      $dateArray = explode(" - ", $date);
      $q->whereBetween('created_at', [$dateArray[0].' 00:00:00', $dateArray[1].' 23:59:59']);
    })
    ->paginate($perPage);

    return view('content.links.histories', compact('linkHistories'));
  }
}
