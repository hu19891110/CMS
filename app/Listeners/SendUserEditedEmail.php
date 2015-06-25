<?php

namespace DCN\Listeners;

use DCN\Events\UserEdited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserEditedEmails implements ShouldQueue
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
     * @param  UserEdited  $event
     * @return void
     */
    public function handle(UserEdited $event)
    {
        //
    }
}
