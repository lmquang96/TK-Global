<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ScanTikTokShopService;
use Carbon\Carbon;

class TikTokShopScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tiktokshop-scan {start_date?} {end_date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ScanTikTokShopService $scanTikTokShopService)
    {
        $startDate = $this->argument('start_date');
        $endDate = $this->argument('end_date');

        $startDate = Carbon::createFromFormat('Ymd H:i:s', $startDate.' 00:00:00');
        $endDate = Carbon::createFromFormat('Ymd H:i:s', $endDate.' 23:59:59');

        $scanTikTokShopService->scan($startDate->timestamp, $endDate->timestamp);

        return 0;
    }
}
