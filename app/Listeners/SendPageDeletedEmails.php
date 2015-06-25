<?php

namespace DCN\Listeners;

use DCN\Events\PageDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPageDeletedEmails implements ShouldQueue
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
     * @param  PageDeleted  $event
     * @return void
     */
    public function handle(PageDeleted $event)
    {
        //
    }
}
