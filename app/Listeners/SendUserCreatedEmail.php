<?php

namespace DCN\Listeners;

use DCN\Events\UserCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendUserCreatedEmails implements ShouldQueue
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;
        Mail::send('emails.user.created', ['user' => $user], function ($m) use ($user) {
            $m->to($user->email, $user->name_full)->subject('You\'r account  has been created!');
        });
    }
}
