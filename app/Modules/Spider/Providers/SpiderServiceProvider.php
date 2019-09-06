<?php
namespace App\Modules\Spider\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SpiderServiceProvider extends ServiceProvider
{
	/**
	 * Register the Spider module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Spider\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Spider module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('spider', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('spider', base_path('resources/views/vendor/spider'));
		View::addNamespace('spider', realpath(__DIR__.'/../Resources/Views'));
	}
}
