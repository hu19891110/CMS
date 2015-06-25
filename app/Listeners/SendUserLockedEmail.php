<?php

namespace DCN\Listeners;

use DCN\Events\UserLocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendUserLockedEmails implements ShouldQueue
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
     * @param  UserLocked  $event
     * @return void
     */
    public function handle(UserLocked $event)
    {
        $user = $event->user;
        Mail::send('emails.user.locked', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name_full)->subject('You\'r account has been locked!');
        });
    }
}
