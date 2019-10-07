<?php
namespace App\Modules\Supplier\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SupplierServiceProvider extends ServiceProvider
{
	/**
	 * Register the Supplier module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\Supplier\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the Supplier module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('supplier', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('supplier', base_path('resources/views/vendor/supplier'));
		View::addNamespace('supplier', realpath(__DIR__.'/../Resources/Views'));
	}
}
