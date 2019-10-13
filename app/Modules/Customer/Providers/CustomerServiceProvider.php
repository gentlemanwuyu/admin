<?php
namespace App\Modules\Customer\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
	/**
	 * Register the Customer module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Customer\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Customer module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('customer', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('customer', base_path('resources/views/vendor/customer'));
		View::addNamespace('customer', realpath(__DIR__.'/../Resources/Views'));
	}
}
