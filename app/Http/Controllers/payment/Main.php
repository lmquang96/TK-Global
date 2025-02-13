<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentRequest;
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

    return view('content.payment.index', compact('flag'));
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

    return response()->json([
      'message' => 'Số dư của bạn không đủ!',
      'data' => []
    ], 400, []);

    // PaymentRequest::query()
    // ->where('')

    $paymentRequest = PaymentRequest::create([
      'submission_date' => Carbon::now()->format('Y-m-d H:i:s'),
      'amount' => $amount,
      'user_id' => auth()->user()->id
    ]);

    return response()->json([
      'message' => 'Đăng ký rút tiền thành công!',
      'data' => []
    ], 200, []);
  }
}
