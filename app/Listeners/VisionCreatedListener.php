<?php

namespace App\Listeners;

use App\Events\VisionCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class VisionCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(VisionCreated $event): void
    {
        Log::info('reached listener');
        Log::info($event->vision?->toArray());
    }
}
