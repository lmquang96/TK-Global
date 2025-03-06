<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversion;
use App\Models\Click;
use Carbon\Carbon;

class Main extends Controller
{
  const PER_PAGE = 25;
  const DEFAULT_SUB_DAYS = 30;

  public function performance(Request $request)
  {
    if (!$request->date) {
      $request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d')." - ".Carbon::now()->format('Y-m-d')]);
    }
    $data = Conversion::with('campaign')
    ->when($request->date, function($q, $date) {
      $dateArray = explode(" - ", $date);
      $q->whereBetween('order_time', [$dateArray[0].' 00:00:00', $dateArray[1].' 23:59:59']);
    })
    ->when($request->keyword, function($q, $keyword) {
      return $q->whereHas('campaign', function ($query) use ($keyword) {
        $query->where('name', 'like', '%'.$keyword.'%');
      });
    })
    ->where('user_id', auth()->user()->id)
    ->selectRaw('campaign_id, count(*) cnt, SUM(unit_price) as total_price, SUM(commission_pub) as total_com')
    ->groupBy('campaign_id');

    $totalConversion = $data->get()->sum(function ($item) {
      return $item->cnt;
    });

    $totalPrice = $data->get()->sum(function ($item) {
      return $item->total_price;
    });

    $totalCom = $data->get()->sum(function ($item) {
      return $item->total_com;
    });

    $data = $data->paginate(self::PER_PAGE)->withQueryString();

    $clicks = Click::query()
    ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
    ->when($request->date, function($q, $date) {
      $dateArray = explode(" - ", $date);
      $q->whereBetween('clicks.created_at', [$dateArray[0].' 00:00:00', $dateArray[1].' 23:59:59']);
    })
    ->when($request->keyword, function($q, $keyword) {
      return $q->join('campaigns', 'campaigns.id', '=', 'link_histories.campaign_id')
      ->where('name', 'like', '%'.$keyword.'%');
    })
    ->where('user_id', auth()->user()->id)
    ->selectRaw('campaign_id, count(*) cnt')
    ->groupBy('campaign_id');

    $clickCount = $clicks->get()->sum(function ($item) {
      return $item->cnt;
    });

    $clicks = $clicks->get();

    $clicks = $clicks->keyBy('campaign_id')->toArray();

    return view('content.report.performance', compact('data', 'clicks', 'totalConversion', 'clickCount', 'totalPrice', 'totalCom'));
  }

  public function order(Request $request)
  {
    if (!$request->date) {
      $request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d')." - ".Carbon::now()->format('Y-m-d')]);
    }

    $data = Conversion::query()
    ->when($request->date, function($q, $date) {
      $dateArray = explode(" - ", $date);
      $q->whereBetween('order_time', [$dateArray[0].' 00:00:00', $dateArray[1].' 23:59:59']);
    })
    ->when($request->keyword, function($q, $keyword) {
      return $q->whereHas('campaign', function ($query) use ($keyword) {
        $query->where('name', 'like', '%'.$keyword.'%');
      });
    })
    ->when($request->code_value, function($q, $codeValue) use ($request) {
      $codeKey = $request->code_key;
      if ($codeKey == null) {
        $codeKey = 'code';
      }
      if ($codeKey == 'code') {
        $q->where('code', $codeValue);
      } else {
        $q->where('order_code', $codeValue);
      }
    })
    ->when($request->status, function($q, $status) {
      $q->where('status', $status);
    })
    ->when($request->sub1, function($q, $sub1) {
      return $q->whereHas('click', function ($query) use ($sub1) {
        return $query->whereHas('linkHistory', function ($qr) use ($sub1) {
          $qr->where('sub1', 'like', '%'.$sub1.'%');
        });
      });
    })
    ->when($request->sub2, function($q, $sub2) {
      return $q->whereHas('click', function ($query) use ($sub2) {
        return $query->whereHas('linkHistory', function ($qr) use ($sub2) {
          $qr->where('sub2', 'like', '%'.$sub2.'%');
        });
      });
    })
    ->when($request->sub3, function($q, $sub3) {
      return $q->whereHas('click', function ($query) use ($sub3) {
        return $query->whereHas('linkHistory', function ($qr) use ($sub3) {
          $qr->where('sub3', 'like', '%'.$sub3.'%');
        });
      });
    })
    ->when($request->sub4, function($q, $sub4) {
      return $q->whereHas('click', function ($query) use ($sub4) {
        return $query->whereHas('linkHistory', function ($qr) use ($sub4) {
          $qr->where('sub4', 'like', '%'.$sub4.'%');
        });
      });
    })
    ->where('user_id', auth()->user()->id);

    $totalConversion = $data->count();

    $totalPrice = $data->get()->sum(function ($item) {
      return $item->quantity * $item->unit_price;
    });

    $totalCom = $data->get()->sum(function ($item) {
      return $item->quantity * $item->commission_pub;
    });

    $data = $data->orderBy('order_time', 'desc')->paginate(self::PER_PAGE)->withQueryString();

    $clickCount = Click::query()
    ->join('link_histories', 'link_histories.id', '=', 'clicks.link_history_id')
    ->when($request->date, function($q, $date) {
      $dateArray = explode(" - ", $date);
      $q->whereBetween('clicks.created_at', [$dateArray[0].' 00:00:00', $dateArray[1].' 23:59:59']);
    })
    ->when($request->keyword, function($q, $keyword) {
      return $q->join('campaigns', 'campaigns.id', '=', 'link_histories.campaign_id')
      ->where('name', 'like', '%'.$keyword.'%');
    })
    ->where('user_id', auth()->user()->id)
    ->count();

    return view('content.report.order', compact('data', 'totalPrice', 'totalCom', 'clickCount', 'totalConversion'));
  }
}
