<?php

namespace App\Http\Controllers\links;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Traffic\LinkService;

class Main extends Controller
{
  public function storeHistory(Request $request, LinkService $linkService)
  {
    $storeHistory = $linkService->storeHistory($request);
    if ($storeHistory['status']) {
      return response()->json(['message' => 'success!', 'data' => $storeHistory['data']], 200, []);
    } else {
      return response()->json(['error', $storeHistory['data']], 200, []);
    }
  }

  public function history(Request $request, LinkService $linkService)
  {
    $linkHistories = $linkService->getHistories($request);

    return view('content.links.histories', compact('linkHistories'));
  }
}
