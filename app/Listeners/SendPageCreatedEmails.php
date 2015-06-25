<?php

namespace DCN\Listeners;

use Mail;
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
        $page = $event->page;
        Mail::send('emails.page.created', ['page' => $page], function ($m) use ($page) {
            $m->to($page->owner->email, $page->owner->name_full)->subject('A page you own was created!');
        });
        Mail::send('emails.page.created', ['page' => $page], function ($m) use ($page) {
            $m->to($page->creator->email, $page->creator->name_full)->subject('Your new page was created!');
        });
    }
}
