<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/20
 * Time: 21:08
 */

namespace App\Modules\Customer\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Modules\Customer\Models\CustomerPaymentMethodApplication;

class AutoDeleteApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:auto_delete_application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自动删除申请单';

    const DAYS = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CustomerPaymentMethodApplication::whereIn('status', [2, 3, 4])->get()->map(function ($application) {
            if (Carbon::now()->subDays(self::DAYS)->toDateTimeString() > $application->updated_at) {
                $application->delete();
                Log::info("申请单[{$application->id}][status:{$application->status}]超过" . self::DAYS . ", 已删除.");
                $this->info("申请单[{$application->id}][status:{$application->status}]超过" . self::DAYS . ", 已删除.");
            }
        });

    }
}