<?php

namespace App\Listeners;

use App\Events\TriggerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class Popupbox
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TriggerEvent  $event
     * @return void
     */
    public function handle(TriggerEvent $event)
    {
        //
    }
}
