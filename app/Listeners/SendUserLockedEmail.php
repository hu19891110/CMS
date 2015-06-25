<?php

namespace DCN\Listeners;

use DCN\Events\UserLocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserLockedEmails implements ShouldQueue
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
     * @param  UserLocked  $event
     * @return void
     */
    public function handle(UserLocked $event)
    {
        //
    }
}
