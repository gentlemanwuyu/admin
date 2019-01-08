<?php
namespace App\Modules\User\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
	/**
	 * Register the User module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\User\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the User module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('user', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('user', base_path('resources/views/vendor/user'));
		View::addNamespace('user', realpath(__DIR__.'/../Resources/Views'));
	}
}
