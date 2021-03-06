<?php
namespace App\Modules\System\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SystemServiceProvider extends ServiceProvider
{
	/**
	 * Register the System module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\System\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the System module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('system', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('system', base_path('resources/views/vendor/system'));
		View::addNamespace('system', realpath(__DIR__.'/../Resources/Views'));
	}
}
