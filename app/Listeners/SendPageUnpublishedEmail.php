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
        $page = $event->page;
        Mail::send('emails.page.unpublished', ['page' => $page], function ($m) use ($page) {
            $m->to($page->owner->email, $page->owner->name_full)->subject('A page you own was unpublished!');
        });
        Mail::send('emails.page.unpublished', ['page' => $page], function ($m) use ($page) {
            $m->to($page->creator->email, $page->creator->name_full)->subject('A page you created was unpublished!');
        });
    }
}
