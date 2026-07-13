<?php

namespace App\Http\Controllers\api\publisher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\ReportRequest;
use App\Services\Conversion\ConversionService;
use App\Http\Resources\ReportResource;

class ReportController extends Controller
{
  const PER_PAGE = 25;

  /**
   * Get Conversions
   *
   * This API exchanges an API Key and API Secret for a short-lived Access Token.
   * ⚠️ Note: This API is publicly accessible and does NOT require a Bearer Token in the header.
   *
   * @queryParam from_date string required From Date. Example: 2026-01-01
   * @queryParam to_date string required To Date. Example: 2026-06-30
   * @queryParam page number Page number. Example: 1
   * @queryParam limit number Items each page. Example: 25
   * @response 200 {
   * "success": true,
   * "message": "Success",
   * "data": {
   *     "items": [
   *         {
   *             "conversion_id": "b7e82fcc5d3c868c233b685975f43f2fa85bfcfc",
   *             "order_code": "1100l2426323454",
   *             "order_time": "2026-06-01 23:42:12",
   *             "price": null,
   *             "quantity": 1,
   *             "commission": null,
   *             "status": "Pending",
   *             "product_code": "1100l1077340452",
   *             "product_name": "Home-Concert Tickets-Artists T - Z-Vacations",
   *             "confirmed_at": null,
   *             "paid_at": null,
   *             "campaign_id": 44
   *         },
   *         ...
   *     ],
   *     "pagination": {
   *         "page": 1,
   *         "perPage": 25,
   *         "total": 168,
   *         "lastPage": 7,
   *         "from": 1,
   *         "to": 25
   *      }
   *    }
   * }
   */
  public function getConversions(ReportRequest $request, ConversionService $conversionService)
  {
    $token = $request->bearerToken();

    if (!$token) {
      return response()->json(['error' => 'Chưa cung cấp Access Token.'], 401);
    }

    $conversions = $conversionService->getConversions($request, 'client');

    if (is_array($conversions)) {
      return response()->error($conversions['data'], 401, 'invalid_token');
    }

    $data = $conversions->orderBy('order_time', 'desc')->paginate($request->limit ?? self::PER_PAGE);

    $items = ReportResource::collection($data);

    return response()->success([
      'items' => $items,
      'pagination' => [
        'page'      => $data->currentPage(),
        'perPage'  => $data->perPage(),
        'total'     => $data->total(),
        'lastPage' => $data->lastPage(),
        'from'      => $data->firstItem(),
        'to'        => $data->lastItem(),
      ],
    ]);
  }
}
