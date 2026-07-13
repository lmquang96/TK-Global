<?php

namespace App\Services\Conversion;

use App\Models\ClientCredential;
use App\Models\Conversion;
use App\Models\OauthToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ConversionService
{
  const PER_PAGE = 25;
  const MSG_MISSING_TOKEN = 'Missing token!';
  const MSG_TOKEN_EXPIRED = 'Token expired!';

  public function getConversionsGroupByCampagin($request)
  {
    $data = Conversion::with('campaign')
      ->when($request->date, function ($q, $date) {
        $dateArray = explode(" - ", $date);
        $q->whereBetween('order_time', [$dateArray[0] . ' 00:00:00', $dateArray[1] . ' 23:59:59']);
      })
      ->when($request->keyword, function ($q, $keyword) {
        return $q->whereHas('campaign', function ($query) use ($keyword) {
          $query->where('name', 'like', '%' . $keyword . '%');
        });
      })
      ->when($request->status, function ($q, $status) {
        if ($status == 'Paid') {
          $q->where('status', 'Approved')
            ->whereNotNull('paid_at');
        } else {
          $q->where('status', $status);
        }
      })
      ->where('user_id', Auth::user()->id)
      ->selectRaw('campaign_id, count(*) cnt, SUM(unit_price) as total_price, SUM(commission_pub) as total_com')
      ->groupBy('campaign_id');

    return $data;
  }

  public function getConversions($request, $rule = 'server')
  {
    $token = $request->bearerToken();
    $tokenData = null;
    if ($rule === 'client') {
      $tokenData = $this->validToken($token);
      if (is_array($tokenData) && !$tokenData['status']) {
        return $tokenData;
      }
    }

    $data = Conversion::query()
      ->when($request->date, function ($q, $date) {
        $dateArray = explode(" - ", $date);
        $q->whereBetween('order_time', [$dateArray[0] . ' 00:00:00', $dateArray[1] . ' 23:59:59']);
      })
      ->when($request->from_date && $request->to_date, function ($q) use ($request) {
        $q->whereBetween('order_time', [$request->from_date . ' 00:00:00', $request->to_date . ' 23:59:59']);
      })
      ->when($request->keyword, function ($q, $keyword) {
        return $q->whereHas('campaign', function ($query) use ($keyword) {
          $query->where('name', 'like', '%' . $keyword . '%');
        });
      })
      ->when($request->code_value, function ($q, $codeValue) use ($request) {
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
      ->when($request->status, function ($q, $status) {
        if ($status == 'Paid') {
          $q->where('status', 'Approved')
            ->whereNotNull('paid_at');
        } else {
          $q->where('status', $status);
        }
      })
      ->when($request->sub1, function ($q, $sub1) {
        return $q->whereHas('click', function ($query) use ($sub1) {
          return $query->whereHas('linkHistory', function ($qr) use ($sub1) {
            $qr->where('sub1', 'like', '%' . $sub1 . '%');
          });
        });
      })
      ->when($request->sub2, function ($q, $sub2) {
        return $q->whereHas('click', function ($query) use ($sub2) {
          return $query->whereHas('linkHistory', function ($qr) use ($sub2) {
            $qr->where('sub2', 'like', '%' . $sub2 . '%');
          });
        });
      })
      ->when($request->sub3, function ($q, $sub3) {
        return $q->whereHas('click', function ($query) use ($sub3) {
          return $query->whereHas('linkHistory', function ($qr) use ($sub3) {
            $qr->where('sub3', 'like', '%' . $sub3 . '%');
          });
        });
      })
      ->when($request->sub4, function ($q, $sub4) {
        return $q->whereHas('click', function ($query) use ($sub4) {
          return $query->whereHas('linkHistory', function ($qr) use ($sub4) {
            $qr->where('sub4', 'like', '%' . $sub4 . '%');
          });
        });
      })
      ->when($rule === 'server', function ($q) {
        return $q->where('user_id', Auth::user()->id);
      })
      ->when($rule === 'client', function ($q) use ($tokenData) {
        $userId = $tokenData->clientCredential->user_id;
        // return $q->where('user_id', $userId);
        return $q->where('user_id', 24);
      });

    return $data;
  }

  private function validToken($token)
  {
    if (!$token) {
      return [
        'status' => false,
        'data' => self::MSG_MISSING_TOKEN
      ];
    }

    $tokenData = OauthToken::where('token_hash', $token)->first();

    if (!$tokenData) {
      return [
        'status' => false,
        'data' => self::MSG_MISSING_TOKEN
      ];
    }

    $now = Carbon::now();
    $expiresAt = Carbon::parse($tokenData->expires_at);

    if ($expiresAt->diffInHours($now) > 6) {
      return [
        'status' => false,
        'data' => self::MSG_TOKEN_EXPIRED
      ];
    }

    return $tokenData;
  }
}
