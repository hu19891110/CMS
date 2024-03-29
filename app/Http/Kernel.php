<?php namespace DCN\Http;

use DCN\RBAC\Middleware\VerifyPermission;
use DCN\RBAC\Middleware\VerifyRole;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
        CheckForMaintenanceMode::class,
		EncryptCookies::class,
		AddQueuedCookiesToResponse::class,
		StartSession::class,
		ShareErrorsFromSession::class,
		Middleware\VerifyCsrfToken::class,
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => Middleware\Authenticate::class,
		'auth.basic' => AuthenticateWithBasicAuth::class,
		'guest' => Middleware\RedirectIfAuthenticated::class,

        'role' => VerifyRole::class,
        'permission' => VerifyPermission::class,
	];

}
