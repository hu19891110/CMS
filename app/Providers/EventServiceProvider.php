<?php namespace DCN\Providers;

use DCN\Events\PageCreated;
use DCN\Events\PageDeleted;
use DCN\Events\PageEdited;
use DCN\Events\PagePublished;
use DCN\Events\PageUnpublished;
use DCN\Events\UserBanned;
use DCN\Events\UserCreated;
use DCN\Events\UserDeleted;
use DCN\Events\UserEdited;
use DCN\Events\UserLocked;
use DCN\Events\UserPasswordChanged;
use DCN\Events\UserUnbanned;
use DCN\Events\UserUnlocked;
use DCN\Listeners\SendPageCreatedEmails;
use DCN\Listeners\SendPageDeletedEmails;
use DCN\Listeners\SendPageEditedEmails;
use DCN\Listeners\SendPagePublishedEmails;
use DCN\Listeners\SendPageUnpublishedEmails;
use DCN\Listeners\SendUserBannedEmails;
use DCN\Listeners\SendUserCreatedEmails;
use DCN\Listeners\SendUserDeletedEmails;
use DCN\Listeners\SendUserEditedEmails;
use DCN\Listeners\SendUserLockedEmails;
use DCN\Listeners\SendUserPasswordChangedEmails;
use DCN\Listeners\SendUserUnbannedEmails;
use DCN\Listeners\SendUserUnlockedEmails;
use DCN\Listeners\YubiKeyAuth;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
        PageCreated::class => [
            SendPageCreatedEmails::class,
        ],
        PageDeleted::class => [
            SendPageDeletedEmails::class,
        ],
        PageEdited::class => [
            SendPageEditedEmails::class,
        ],
        PagePublished::class => [
            SendPagePublishedEmails::class,
        ],
        PageUnpublished::class => [
            SendPageUnpublishedEmails::class,
        ],
        UserBanned::class => [
            SendUserBannedEmails::class,
        ],
        UserCreated::class => [
            SendUserCreatedEmails::class,
        ],
        UserDeleted::class => [
            SendUserDeletedEmails::class,
        ],
        UserEdited::class => [
            SendUserEditedEmails::class,
        ],
        UserLocked::class => [
            SendUserLockedEmails::class,
        ],
        UserPasswordChanged::class => [
            SendUserPasswordChangedEmails::class,
        ],
        UserUnbanned::class => [
            SendUserUnbannedEmails::class,
        ],
        UserUnlocked::class => [
            SendUserUnlockedEmails::class,
        ],
        'auth.login' => [
            YubiKeyAuth::class
        ]
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
