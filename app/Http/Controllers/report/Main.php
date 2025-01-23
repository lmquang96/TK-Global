<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Conversion;
use App\Models\Click;

class Main extends Controller
{
  const PER_PAGE = 25;

  public function performance()
  {
    return view('content.report.performance');
  }

  public function order(Request $request)
  {
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
    });

    $totalConversion = $data->count();

    $totalPrice = $data->get()->sum(function ($item) {
      return $item->quantity * $item->unit_price;
    });

    $totalCom = $data->get()->sum(function ($item) {
      return $item->quantity * $item->commission_pub;
    });

    $linkHistoryIds = $data->get()->map(function ($conversion) {
      return $conversion->click->link_history_id;
    });

    $linkHistoryIds = $linkHistoryIds->unique();

    $data = $data->paginate(self::PER_PAGE);

    $clickCount = Click::whereIn('link_history_id', $linkHistoryIds)->count();

    return view('content.report.order', compact('data', 'totalPrice', 'totalCom', 'clickCount', 'totalConversion'));
  }
}
