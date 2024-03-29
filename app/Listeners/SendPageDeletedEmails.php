<?php

namespace DCN\Listeners;

use DCN\Events\PageDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

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
        $page = $event->page;
        Mail::send('emails.page.deleted', ['page' => $page], function ($m) use ($page) {
            $m->to($page->owner->email, $page->owner->name_full)->subject('A page you own was deleted!');
        });
        Mail::send('emails.page.deleted', ['page' => $page], function ($m) use ($page) {
            $m->to($page->creator->email, $page->creator->name_full)->subject('A page you created was deleted!');
        });
    }
}
