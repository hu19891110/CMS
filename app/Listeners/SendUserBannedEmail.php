<?php

namespace DCN\Listeners;

use DCN\Events\UserBanned;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendUserBannedEmails implements ShouldQueue
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
     * @param  UserBanned  $event
     * @return void
     */
    public function handle(UserBanned $event)
    {
        $user = $event->user;
        Mail::send('emails.user.banned', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name_full)->subject('You\'r account has been banned!');
        });
    }
}
