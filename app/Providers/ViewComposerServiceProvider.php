<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/1/8
 * Time: 17:39
 */
namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\ViewComposers\TemplateComposer;
use App\ViewComposers\WildComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', WildComposer::class);
        View::composer(['layouts.header', 'layouts.sidebar', 'layouts.footer'], TemplateComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}