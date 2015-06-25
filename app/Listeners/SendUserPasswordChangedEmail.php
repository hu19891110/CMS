<?php

namespace DCN\Listeners;

use DCN\Events\UserPasswordChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendUserPasswordChangedEmails implements ShouldQueue
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
     * @param  UserPasswordChanged  $event
     * @return void
     */
    public function handle(UserPasswordChanged $event)
    {
        $user = $event->user;
        Mail::send('emails.user.password-changed', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name_full)->subject('You\'r password has been changed!');
        });
    }
}
