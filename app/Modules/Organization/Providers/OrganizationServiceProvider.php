<?php
namespace App\Modules\Organization\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class OrganizationServiceProvider extends ServiceProvider
{
	/**
	 * Register the Organization module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Organization\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Organization module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('organization', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('organization', base_path('resources/views/vendor/organization'));
		View::addNamespace('organization', realpath(__DIR__.'/../Resources/Views'));
	}
}
