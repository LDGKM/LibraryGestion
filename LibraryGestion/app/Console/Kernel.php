<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ProcessPendingLoansJob;
use App\Jobs\CheckOverdueLoansJob;
use App\Jobs\ProcessPenalityLoansJob;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new ProcessPendingLoansJob)->everyMinute();
        $schedule->job(new CheckOverdueLoansJob)->everyMinute();
        $schedule->job(new ProcessPenalityLoansJob)->dailyAt('00:00');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
