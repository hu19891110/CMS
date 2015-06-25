<?php

namespace DCN\Listeners;

use DCN\Events\UserUnlocked;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendUserUnlockedEmails implements ShouldQueue
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
     * @param  UserUnlocked  $event
     * @return void
     */
    public function handle(UserUnlocked $event)
    {
        $user = $event->user;
        Mail::send('emails.user.unlocked', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name_full)->subject('You\'r account has been unlocked!');
        });
    }
}
