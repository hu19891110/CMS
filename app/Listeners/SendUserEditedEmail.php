<?php

namespace DCN\Listeners;

use DCN\Events\UserEdited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

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
        $user = $event->user;
        //TODO: Check was was edited. If roles/permissions, don't sent.
        Mail::send('emails.user.edited', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name_full)->subject('You\'r account has been edited!');
        });
    }
}
