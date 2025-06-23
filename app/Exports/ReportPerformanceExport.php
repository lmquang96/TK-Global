<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;
use App\Services\Conversion\ConversionService;
use App\Services\Traffic\ClickService;
use Carbon\Carbon;
use App\Common\Transformer\Performance as PerformanceTransformer;

class ReportPerformanceExport implements FromCollection, WithHeadings
{
  /**
   * @return \Illuminate\Support\Collection
   */

  const DEFAULT_SUB_DAYS = 7;

  protected $request;
  protected $conversionService;
  protected $clickService;

  public function __construct(Request $request, ConversionService $conversionService, ClickService $clickService)
  {
    $this->request = $request;
    $this->conversionService = $conversionService;
    $this->clickService = $clickService;
  }

  public function headings(): array
  {
    return [
      "Chiến dịch",
      "Lượt click",
      "Chuyển đổi",
      "Giá trị chuyển đổi",
      "Hoa hồng",
      "Tỉ lệ"
    ];
  }

  public function collection()
  {
    if (!$this->request->date) {
      $this->request->merge(['date' => Carbon::now()->subDays(self::DEFAULT_SUB_DAYS)->format('Y-m-d') . " - " . Carbon::now()->format('Y-m-d')]);
    }

    $data = $this->conversionService->getConversionsGroupByCampagin($this->request);

    $data = $data->get();

    $clicksDataBuilder = $this->clickService->getClicksGroupByCampagin($this->request);

    $clicks = $clicksDataBuilder->get();

    $clicks = $clicks->keyBy('campaign_id')->toArray();

    $results = $data->map(fn($item) => PerformanceTransformer::exportFormat($item, $clicks));

    return collect($results);
  }
}
