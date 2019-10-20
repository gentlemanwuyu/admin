<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\AdminInstall;
use App\Modules\Entrust\Console\InitializeEntrust;
use App\Modules\Customer\Console\Commands\AutoDeleteApplication;
use App\Modules\Spider\Console\CheckProxyIp;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        AdminInstall::class,
        InitializeEntrust::class,
        AutoDeleteApplication::class,
        CheckProxyIp::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

    }
}
