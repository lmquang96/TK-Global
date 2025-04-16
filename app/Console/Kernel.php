<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
  /**
   * Đăng ký các lệnh Artisan của ứng dụng.
   *
   * @return void
   */
  protected $commands = [
    // Đăng ký các lệnh của bạn ở đây
    Commands\ConversionsScan::class, // Ví dụ thêm command của bạn vào đây
  ];

  /**
   * Định nghĩa các công việc lên lịch cho ứng dụng.
   *
   * @param \Illuminate\Console\Scheduling\Schedule $schedule
   * @return void
   */
  protected function schedule(Schedule $schedule)
  {
    // Đặt lịch cho các công việc của bạn ở đây
    $schedule->command('app:conversions-scan')->everyMinute();
  }

  /**
   * Đăng ký các dịch vụ Artisan.
   *
   * @return void
   */
  protected function commands()
  {
    $this->load(__DIR__ . '/Commands');

    require base_path('routes/console.php');
  }
}
