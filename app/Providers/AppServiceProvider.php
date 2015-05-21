<?php namespace DCN\Providers;

use Blade;
use Setting;
use Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
        /*
         * Our Custom oneLine Blade Function
         *
         * Imports a blade, and minifies it into one line
         */
        Blade::extend(function($view, $compiler) {
            $pattern = $compiler->createMatcher('oneLine');
            $replace = "<?php echo implode(\" \",explode(\"\n\",\$__env->make($2, array_except(get_defined_vars(), array('__data', '__path')))->render())); ?>";
            return preg_replace($pattern, $replace, $view);
        });

		//
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
