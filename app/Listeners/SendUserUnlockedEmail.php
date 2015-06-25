<?php

namespace DCN\Listeners;

use DCN\Events\UserUnlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserUnlockedEmails implements ShouldQueue
{
    use InteractsWithQueue;

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
     * @param  UserUnlocked  $event
     * @return void
     */
    public function handle(UserUnlocked $event)
    {
        //
    }
}
