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
        $page = $event->page;
        Mail::send('emails.page.edited', ['page' => $page], function ($m) use ($page) {
            $m->to($page->owner->email, $page->owner->name_full)->subject('A page you own was edited!');
        });
        Mail::send('emails.page.edited', ['page' => $page], function ($m) use ($page) {
            $m->to($page->creator->email, $page->creator->name_full)->subject('A page you created was edited!');
        });
    }
}
