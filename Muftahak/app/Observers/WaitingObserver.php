<?php

namespace App\Observers;

use App\Models\Waiting;
use Illuminate\Support\Facades\Cache;

class WaitingObserver
{
    /**
     * Handle the Waiting "created" event.
     */
    public function created(Waiting $waiting): void
    {
        if($waiting->confirmed==='false'){
            // Schedule deletion after 10 minutes
           Cache::put('delete_waiting_'.$waiting->id, now(),5*60);
        }
    }

    /**
     * Handle the Waiting "updated" event.
     */
    public function updated(Waiting $waiting): void
    {
        //
    }

    /**
     * Handle the Waiting "deleted" event.
     */
    public function deleted(Waiting $waiting): void
    {
        //
    }

    /**
     * Handle the Waiting "restored" event.
     */
    public function restored(Waiting $waiting): void
    {
        //
    }

    /**
     * Handle the Waiting "force deleted" event.
     */
    public function forceDeleted(Waiting $waiting): void
    {
        //
    }
}
