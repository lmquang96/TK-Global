<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ScanConversionsService;

class ConversionsScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:conversions-scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ScanConversionsService $scanConversionsService)
    {
        Log::info('ConversionsScan command running...');
        
        $scanConversionsService->scan();

        return 0;
    }
}
