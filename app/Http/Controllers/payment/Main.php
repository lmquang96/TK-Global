<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentRequest;
use App\Models\Balance;
use App\Models\AdvancePaymentHistory;
use Carbon\Carbon;

class Main extends Controller
{
  public function index()
  {
    $flag = false;
    $today = Carbon::now()->format('d');

    if (in_array($today, [15, 16, 17]) || in_array($today, [27, 28, 29])) {
      $flag = true;
    }

    $balance = Balance::where('user_id', auth()->user()->id)->first();

    if ($balance) {
      $balance = $balance->balance;
    } else {
      $balance = 0;
      Balance::create([
        'code' => sha1(time()),
        'balance' => $balance,
        'last_updated' => Carbon::now(),
        'user_id' => auth()->user()->id
      ]);
    }

    $advances = AdvancePaymentHistory::where('user_id', auth()->user()->id)->get();

    $paymentRequests = PaymentRequest::where('user_id', auth()->user()->id)->where('type', 'pub')->get();

    return view('content.payment.index', compact('flag', 'balance', 'advances', 'paymentRequests'));
  }

  public function submission(Request $request) {
    $request->validate([
      'amount' => 'required|min:200000|numeric',
    ]);

    $amount = $request->amount;

    if ($amount % 10000 !== 0) {
      return false;
    }

    $today = Carbon::now()->format('d');

    if (!in_array($today, [15, 16, 17]) && !in_array($today, [27, 28, 29])) {
      return response()->json([
        'message' => 'Chúng tôi không hỗ trợ rút tiền trong hôm nay!',
        'data' => []
      ], 400, []);
    }

    $phase = 'phase 1';

    $existRequest = PaymentRequest::where('user_id', auth()->user()->id)
    ->whereBetween('submission_date', [Carbon::now()->format('Y-m-01 00:00:00'), Carbon::now()->format('Y-m-31 23:59:59')])
    ->where('type', 'pub')
    ->when(in_array($today, [15, 16, 17]), function($q) {
      $q->where('comment', 'phase 1');
    })
    ->when(in_array($today, [27, 28, 29]), function($q) use (&$phase) {
      $phase = 'phase 2';
      $q->where('comment', 'phase 2');
    })
    ->first();

    if ($existRequest) {
      return response()->json([
        'message' => 'Bạn đã gửi yêu cầu rút tiền trước đó!',
        'data' => []
      ], 400, []);
    }

    $balance = Balance::where('user_id', auth()->user()->id)->first();

    if ($balance->balance < $amount) {
      return response()->json([
        'message' => 'Số dư của bạn không đủ!',
        'data' => []
      ], 400, []);
    }

    PaymentRequest::create([
      'code' => sha1(time()),
      'submission_date' => Carbon::now()->format('Y-m-d H:i:s'),
      'amount' => $amount,
      'comment' => $phase,
      'user_id' => auth()->user()->id
    ]);

    return response()->json([
      'message' => 'Đăng ký rút tiền thành công!',
      'data' => []
    ], 200, []);
  }
}
