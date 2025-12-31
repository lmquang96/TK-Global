<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ScanViatorService;

class ViatorScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:viator-scan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(ScanViatorService $scanViatorSerive)
    {
      $scanViatorSerive->scan();

      return 0;
    }
}
