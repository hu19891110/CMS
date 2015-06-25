<?php

namespace DCN\Listeners;

use DCN\Events\PageCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPageCreatedEmails implements ShouldQueue
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
     * @param  PageCreated  $event
     * @return void
     */
    public function handle(PageCreated $event)
    {
        //
    }
}
