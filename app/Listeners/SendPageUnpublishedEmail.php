<?php

namespace DCN\Listeners;

use DCN\Events\PagePublished;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPageUnpublishedEmails implements ShouldQueue
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
     * @param  PagePublished  $event
     * @return void
     */
    public function handle(PagePublished $event)
    {
        //
    }
}
