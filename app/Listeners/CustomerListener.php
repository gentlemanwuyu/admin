<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/18
 * Time: 16:43
 */

namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Modules\Customer\Models\Customer;

class CustomerListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserDeleted $event
     */
    public function handle(UserDeleted $event)
    {
        try {
            // 用户删除之后，自动将所有客户归入用户池
            $customers = Customer::where('manager_id', $event->user_id)->get();
            if (!$customers->isEmpty()) {
                DB::beginTransaction();
                foreach ($customers as $customer) {
                    $customer->manager_id = 0;
                    $customer->save();
                }

                DB::commit();
                Log::info("用户[{$event->user_id}]已经归入客户池");
            }
        }catch (\Exception $e) {
            DB::rollBack();
            Log::info("[CustomerListener][" . get_class($e) . "]" . $e->getMessage());
        }
    }
}