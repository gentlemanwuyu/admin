<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/16
 * Time: 20:14
 */

namespace App\Modules\Customer\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modules\Customer\Repositories\CustomerRepository;
use App\Modules\Customer\Repositories\CustomerLogRepository;

class CustomerService
{
    protected $customerRepository;
    protected $customerLogRepository;

    protected $user;

    public function __construct(CustomerRepository $customerRepository, CustomerLogRepository $customerLogRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->customerLogRepository = $customerLogRepository;
        $this->user = Auth::user();
    }

    public function myCustomerList($request)
    {
        return  $this->customerRepository->paginate();
    }

    /**
     * 添加/修改客户
     *
     * @param $request
     * @return array
     */
    public function createOrUpdateCustomer($request)
    {

        try {
            $data = [
                'name' => $request->get('name'),
                'code' => $request->get('code', ''),
                'company' => $request->get('company', ''),
                'phone_number' => $request->get('phone', ''),
                'fax' => $request->get('fax', ''),
                'country_code' => $request->get('country_code', ''),
                'state_id' => $request->get('state_id', 0),
                'city_id' => $request->get('city_id', 0),
                'county_id' => $request->get('county_id', 0),
                'street_address' => $request->get('street_address', ''),
                'address' => $request->get('address', ''),
                'introduction' => $request->get('introduction', ''),
            ];

            DB::beginTransaction();

            // 写入/更新产品数据
            if ('update' == $request->get('action')) {
                $customer = $this->customerRepository->update($data, $request->get('customer_id'));
            }else {
                $data['manager_id'] = $this->user->id;
                $customer = $this->customerRepository->create($data);
            }
            if (!$customer) {
                throw new \Exception('Create customer failed.');
            }
            $customer->syncContacts($request->get('contacts'));
            // 记录日志
            $msg_arr = $data;
            if ($request->get('contacts')) {
                $msg_arr['contacts'] = $request->get('contacts');
            }
            $this->customerLogRepository->create([
                'customer_id' => $customer->id,
                'action' => 'update' == $request->get('action') ? 2 : 1,
                'message' => json_encode($msg_arr),
                'user_id' => $this->user->id,
            ]);

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 删除客户
     *
     * @param $customer_id
     * @return array
     */
    public function deleteSupplier($customer_id)
    {
        try {
            DB::beginTransaction();
            $this->customerRepository->delete($customer_id);

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}