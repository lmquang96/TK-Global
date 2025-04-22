<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Payment\PaymentService;

class Main extends Controller
{
  public function index(PaymentService $paymentService)
  {
    $flag = $paymentService->getPaymentFlag();

    $balance = $paymentService->getBalance();

    $advances = $paymentService->getAdvancePaymentHistories();

    $paymentRequests = $paymentService->getPaymentRequests();

    return view('content.payment.index', compact('flag', 'balance', 'advances', 'paymentRequests'));
  }

  public function submission(Request $request, PaymentService $paymentService)
  {
    $request->validate([
      'amount' => 'required|min:200000|numeric',
    ]);

    $withdraw = $paymentService->withdraw($request);

    return response()->json($withdraw, 200, []);
  }
}
