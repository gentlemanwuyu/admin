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
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Repositories\UserRepository;
use App\Modules\Customer\Repositories\CustomerRepository;
use App\Modules\Customer\Repositories\CustomerLogRepository;
use App\Modules\Customer\Repositories\CustomerPaymentMethodApplicationRepository;
use App\Modules\Customer\Repositories\Criteria\Customer\IsBlackEqual;
use App\Modules\Customer\Repositories\Criteria\Customer\ManagerIdIn;
use App\Modules\Customer\Repositories\Criteria\Customer\ManagerIdNotEqualZero;
use App\Modules\Customer\Models\CustomerPaymentMethod;

class CustomerService
{
    protected $userRepository;
    protected $customerRepository;
    protected $customerLogRepository;
    protected $customerPaymentMethodApplicationRepository;

    protected $user;

    public function __construct(CustomerRepository $customerRepository,
                                CustomerLogRepository $customerLogRepository,
                                UserRepository $userRepository,
                                CustomerPaymentMethodApplicationRepository $customerPaymentMethodApplicationRepository)
    {
        $this->userRepository = $userRepository;
        $this->customerRepository = $customerRepository;
        $this->customerLogRepository = $customerLogRepository;
        $this->customerPaymentMethodApplicationRepository = $customerPaymentMethodApplicationRepository;
        $this->user = Auth::user();
    }

    /**
     * 我的客户
     *
     * @param $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function myCustomerList($request)
    {
        $this->customerRepository->pushCriteria(new IsBlackEqual(1));
        if (AuthService::isAdmin()) {
            $this->customerRepository->pushCriteria(new ManagerIdNotEqualZero);
        }else {
            $this->customerRepository->pushCriteria(new ManagerIdIn([$this->user->id]));
        }

        return  $this->customerRepository->paginate();
    }

    public function blackList($request)
    {
        $this->customerRepository->pushCriteria(new IsBlackEqual(2));

        return  $this->customerRepository->paginate();
    }

    public function customerPool($request)
    {
        $this->customerRepository->pushCriteria(new ManagerIdIn([0]));
        $this->customerRepository->pushCriteria(new IsBlackEqual(1));

        return  $this->customerRepository->paginate();
    }

    public function getPaymentMethodApplicationList($request)
    {
        return $this->customerPaymentMethodApplicationRepository->paginate();
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
                if ('my_customer' == $request->get('source')) {
                    $data['manager_id'] = $this->user->id;
                }
                $data['parent_id'] = $request->get('parent_id', 0);
                $customer = $this->customerRepository->create($data);
            }
            if (!$customer) {
                throw new \Exception('Create customer failed.');
            }
            $customer->syncContacts($request->get('contacts'));

            // 付款方式
            if ('create' == $request->get('action') && 'my_customer' == $request->get('source')) {
                $payment_method_data = [
                    'method_id' => $request->get('payment_method_id'),
                ];
                if (2 == $payment_method_data['method_id']) {
                    $payment_method_data['limit_amount'] = $request->get('limit_amount');
                }elseif (3 == $payment_method_data['method_id']) {
                    $payment_method_data['monthly_day'] = $request->get('monthly_day');
                }
                $payment_method_data['customer_id'] = $customer->id;

                if (1 == $payment_method_data['method_id'] || AuthService::isAdmin()) {
                    CustomerPaymentMethod::create($payment_method_data);
                }else {
                    $payment_method_data['message'] = $request->get('apply_reason', '');
                    $payment_method_data['user_id'] = $this->user->id;
                    $this->customerPaymentMethodApplicationRepository->create($payment_method_data);
                }
            }

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

    /**
     * 拉黑客户
     *
     * @param $customer_id
     * @param $reason
     * @return array
     */
    public function blackCustomer($customer_id, $reason)
    {
        try {
            DB::beginTransaction();
            $customer = $this->customerRepository->update(['is_black' => 2, 'manager_id' => 0], $customer_id);
            // 清空付款方式及关闭付款方式申请
            $customer->clearPaymentMethod();
            $this->customerLogRepository->create([
                'customer_id' => $customer_id,
                'action' => 3,
                'message' => $reason,
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
     * 释放客户
     *
     * @param $customer_id
     * @return array
     */
    public function releaseCustomer($customer_id)
    {
        try {
            DB::beginTransaction();
            $this->customerRepository->update(['is_black' => 1, 'manager_id' => 0], $customer_id);
            $this->customerLogRepository->create([
                'customer_id' => $customer_id,
                'action' => 4,
                'message' => '',
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
     * 分配客户
     *
     * @param $customer_id
     * @param $manager_id
     * @return array
     */
    public function assignCustomer($customer_id, $manager_id)
    {
        try {
            DB::beginTransaction();
            $this->customerRepository->update(['is_black' => 1, 'manager_id' => $manager_id], $customer_id);
            $user = $this->userRepository->find($manager_id);
            $this->customerLogRepository->create([
                'customer_id' => $customer_id,
                'action' => 8,
                'message' => '分配客户给' . $user->name,
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
     * 放弃客户
     *
     * @param $customer_id
     * @return array
     */
    public function abandonCustomer($customer_id)
    {
        try {
            DB::beginTransaction();
            $customer = $this->customerRepository->update(['manager_id' => 0], $customer_id);
            $customer->clearPaymentMethod();
            $this->customerLogRepository->create([
                'customer_id' => $customer_id,
                'action' => 7,
                'message' => '',
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
     * 创建/修改付款方式申请单
     *
     * @param $request
     * @return array
     */
    public function updatePaymentMethodApplication($request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'method_id' => $request->get('payment_method_id'),
                'limit_amount' => $request->get('limit_amount'),
                'monthly_day' => $request->get('monthly_day'),
                'message' => $request->get('apply_reason'),
            ];

            if ('update' == $request->get('action')) {
                $data['status'] = 1;
                $this->customerPaymentMethodApplicationRepository->update($data, $request->get('application_id'));
            }

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }

    /**
     * 更改付款方式
     *
     * @param $request
     * @return array
     */
    public function changePaymentMethod($request)
    {
        try {
            $data = [
                'method_id' => $request->get('payment_method_id'),
                'customer_id' => $request->get('customer_id'),
                'limit_amount' => $request->get('limit_amount', 0),
                'monthly_day' => $request->get('monthly_day', 0),
            ];

            if (1 == $request->get('payment_method_id') || AuthService::isAdmin()) {
                CustomerPaymentMethod::updateOrCreate(['customer_id' => $request->get('customer_id')], $data);
                $message = trans('customer::customer.payment_method_change_successful');
            }else {
                $data['message'] = $request->get('apply_reason');
                $data['user_id'] = $this->user->id;
                $this->customerPaymentMethodApplicationRepository->create($data);
                $message = trans('customer::customer.payment_method_application_create_successful');
            }
            return ['status' => 'success', 'msg' => $message];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}