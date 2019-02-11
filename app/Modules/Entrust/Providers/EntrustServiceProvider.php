<?php
namespace App\Modules\Entrust\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class EntrustServiceProvider extends ServiceProvider
{
	/**
	 * Register the Entrust module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Entrust\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Entrust module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('entrust', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('entrust', base_path('resources/views/vendor/entrust'));
		View::addNamespace('entrust', realpath(__DIR__.'/../Resources/Views'));
	}
}
