<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ScanPartnerizeService;
use Carbon\Carbon;

class PartnerizeScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:partnerize-scan {start_date?} {end_date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ScanPartnerizeService $scanPartnerizeService)
    {
      $startDate = $this->argument('start_date');
      $endDate = $this->argument('end_date');

      $startDate = Carbon::createFromFormat('Ymd', $startDate);
      $endDate = Carbon::createFromFormat('Ymd', $endDate);

      $scanPartnerizeService->scan($startDate->format('Y-m-d'), $endDate->format('Y-m-d'));

      return 0;
    }
}
