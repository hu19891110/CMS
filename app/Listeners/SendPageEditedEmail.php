<?php

namespace DCN\Listeners;

use DCN\Events\PageEdited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPageEditedEmails implements ShouldQueue
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
     * @param  PageEdited  $event
     * @return void
     */
    public function handle(PageEdited $event)
    {
        //
    }
}
