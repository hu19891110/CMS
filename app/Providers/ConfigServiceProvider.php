<?php namespace DCN\Providers;

use DCN\Settings;
use Config;
use Schema;
use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {

    public function boot()
    {
        if(Schema::hasTable('settings'))
            foreach(Settings::all() as $setting)
                Config::set($setting->key, $setting->value);
    }
	/**
	 * Overwrite any vendor / package configuration.
	 *
	 * This service provider is intended to provide a convenient location for you
	 * to overwrite any "vendor" or package configuration that you may want to
	 * modify before the application handles the incoming request / command.
	 *
	 * @return void
	 */
	public function register()
	{
        config([
            //
        ]);
	}

}
