<?php

namespace App\Services\Payment;

use App\Models\Balance;
use App\Models\AdvancePaymentHistory;
use App\Models\PaymentRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentService
{

  protected $userId;

  public function __construct()
  {
    $this->userId = Auth::user()->id;
  }

  public function getBalance()
  {
    $userId = $this->userId;
    $sql = "
    SELECT SUM(amount_pub) - SUM(paid) - SUM(advance) AS balance
    FROM (
      SELECT SUM(amount_pub) amount_pub
        ,0 paid
        ,0 advance
      FROM transactions
      WHERE user_id = $userId
      
      UNION ALL
      
      SELECT 0 amount_pub
        ,SUM(amount) paid
        ,0 advance
      FROM payment_requests
      WHERE user_id = $userId
      
      UNION ALL
      
      SELECT 0 amount_pub
        ,0 paid
        ,SUM(amount)
      FROM advance_payment_histories
      WHERE user_id = $userId
      ) a
    ";
    $balance = DB::select($sql);
    // $balance = Balance::where('user_id', $this->userId)->first();

    if ($balance[0]) {
      $balance = $balance[0]->balance;
    } else {
      $balance = 0;
      // Balance::create([
      //   'code' => sha1(time()),
      //   'balance' => $balance,
      //   'last_updated' => Carbon::now(),
      //   'user_id' => $this->userId
      // ]);
    }

    return $balance;
  }

  public function getAdvancePaymentHistories()
  {
    return AdvancePaymentHistory::where('user_id', $this->userId)->get();
  }

  public function getPaymentRequests()
  {
    return PaymentRequest::where('user_id', $this->userId)->where('type', 'pub')->get();
  }

  public function getPaymentFlag()
  {
    $flag = false;
    $today = Carbon::now()->format('d');

    if (in_array($today, [15, 16, 17]) || in_array($today, [27, 28, 29])) {
      $flag = true;
    }

    return $flag;
  }

  public function withdraw($request)
  {
    $amount = $request->amount;

    if ($amount % 10000 !== 0) {
      return [
        'status' => 400,
        'message' => 'Số tiền không là bội số của 10.000!',
        'data' => []
      ];
    }

    $today = Carbon::now()->format('d');

    if (!in_array($today, [15, 16, 17]) && !in_array($today, [27, 28, 29])) {
      return [
        'status' => 400,
        'message' => 'Chúng tôi không hỗ trợ rút tiền trong hôm nay!',
        'data' => []
      ];
    }

    $phase = 'phase 1';

    $existRequest = PaymentRequest::where('user_id', $this->userId)
      ->whereBetween('submission_date', [Carbon::now()->format('Y-m-01 00:00:00'), Carbon::now()->format('Y-m-31 23:59:59')])
      ->where('type', 'pub')
      ->when(in_array($today, [15, 16, 17]), function ($q) {
        $q->where('comment', 'phase 1');
      })
      ->when(in_array($today, [27, 28, 29]), function ($q) use (&$phase) {
        $phase = 'phase 2';
        $q->where('comment', 'phase 2');
      })
      ->first();

    if ($existRequest) {
      return [
        'status' => 400,
        'message' => 'Bạn đã gửi yêu cầu rút tiền trước đó!',
        'data' => []
      ];
    }

    $balance = self::getBalance();

    if ($balance < $amount) {
      return [
        'status' => 400,
        'message' => 'Số dư của bạn không đủ!',
        'data' => []
      ];
    }

    PaymentRequest::create([
      'code' => sha1(time()),
      'submission_date' => Carbon::now()->format('Y-m-d H:i:s'),
      'amount' => $amount,
      'comment' => $phase,
      'user_id' => $this->userId
    ]);

    return [
      'status' => 200,
      'message' => 'Đăng ký rút tiền thành công!',
      'data' => []
    ];
  }
}
