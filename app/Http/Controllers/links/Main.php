<?php

namespace App\Http\Controllers\links;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkHistory;

class Main extends Controller
{
    public function storeHistory(Request $request) {
        $linkHistory = new LinkHistory;

        $linkHistory->originial_url = $request->originalLink;
        $linkHistory->tracking_url = $request->linkTracking;
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

            return response()->json(['message' => 'success!'], 200, []);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return response()->json(['error', $e->getMessage()], 200, []);
        }
    }
}
