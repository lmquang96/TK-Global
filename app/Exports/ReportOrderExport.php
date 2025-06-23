<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use App\Services\Conversion\ConversionService;
use Carbon\Carbon;
use App\Common\Transformer\Order as OrderTransformer;

class ReportOrderExport implements FromCollection, WithHeadings
{
  /**
   * @return \Illuminate\Support\Collection
   */

  const DEFAULT_SUB_DAYS = 7;

  protected $request;
  protected $conversionService;

  public function __construct(Request $request, ConversionService $conversionService)
  {
    $this->request = $request;
    $this->conversionService = $conversionService;
  }

  public function headings(): array
  {
    return [
      "ID chuyển đổi",
      "Thời gian phát sinh",
      "Thời gian click",
      "Chiến dịch",
      "ID đơn hàng",
      "Giá trị đơn hàng(₫)",
      "Hoa hồng(₫)",
      "Trạng thái",
      "Sub ID 1",
      "Sub ID 2",
      "Sub ID 3",
      "Sub ID 4"
    ];
  }

  public function collection()
  {
    if (!$this->request->date) {
      $this->request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d') . " - " . Carbon::now()->format('Y-m-d')]);
    }

    $data = $this->conversionService->getConversions($this->request);

    $data = $data->get();

    $results = $data->map(fn($item) => OrderTransformer::exportFormat($item));

    return collect($results);
  }
}
