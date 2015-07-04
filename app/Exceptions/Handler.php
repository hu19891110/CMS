<?php namespace DCN\Exceptions;

use Bican\Roles\Exceptions\AccessDeniedException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException',
        '\DCN\RBAC\Exceptions\RoleDeniedException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
        if ($e instanceof AccessDeniedException) {
            // you can for example flash message, redirect...
            return redirect('/')->withErrors('Access Denied');
        }

        if($e instanceof \DCN\RBAC\Exceptions\RoleDeniedException) {
            // you can for example flash message, redirect...
            return redirect()->guest(route('auth.login'))->withErrors('You don\'t have the required Role.');
        }

        if($e instanceof \DCN\RBAC\Exceptions\PermissionDeniedException) {
            // you can for example flash message, redirect...
            return redirect()->guest(route('auth.login'))->withErrors('You don\'t have the required Permission.');
        }

		return parent::render($request, $e);
	}

}
