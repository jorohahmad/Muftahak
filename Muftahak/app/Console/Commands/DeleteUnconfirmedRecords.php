<?php

namespace App\Console\Commands;

use App\Models\UserApartment;
use Illuminate\Console\Command;

class DeleteUnconfirmedRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'waitings:delete-unconfirmed-records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unconfirmed records from the waitings table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timeLimit = now()->subMinutes(2);
        $deletedCount = \App\Models\Waiting::where('created_at', '<', $timeLimit)
            ->where('confirmed', 'false')
            ->delete();
        $this->info("Deleted {$deletedCount} unconfirmed records from the waitings table.");
    }
}
