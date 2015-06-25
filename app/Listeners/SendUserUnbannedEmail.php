<?php

namespace DCN\Listeners;

use DCN\Events\UserUnbanned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserUnbannedEmails implements ShouldQueue
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
     * @param  UserUnbanned  $event
     * @return void
     */
    public function handle(UserUnbanned $event)
    {
        //
    }
}
