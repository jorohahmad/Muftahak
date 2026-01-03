<?php

namespace App\Console;

// use Illuminate\Support\Facades\Schedule;

use App\Console\Commands\DeleteUnconfirmedRecords;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\ConsoleKernel as ConsoleKernel;

class Kernel extends DeleteUnconfirmedRecords
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('waitings:delete-unconfirmed-records')->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
