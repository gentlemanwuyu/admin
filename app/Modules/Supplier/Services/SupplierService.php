<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 8:52
 */

namespace App\Modules\Supplier\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Modules\Supplier\Repositories\SupplierRepository;
use App\Modules\Supplier\Repositories\SupplierLogRepository;
use App\Modules\Supplier\Repositories\Criteria\Supplier\NameLike;
use App\Modules\Supplier\Repositories\Criteria\Supplier\IsBlackEqual;

class SupplierService
{
    protected $supplierRepository;
    protected $supplierLogRepository;

    protected $user;

    public function __construct(SupplierRepository $supplierRepository, SupplierLogRepository $supplierLogRepository)
    {
        $this->supplierRepository = $supplierRepository;
        $this->supplierLogRepository = $supplierLogRepository;
        $this->user = Auth::user();
    }

    public function getList($request)
    {
        $this->supplierRepository->pushCriteria(new NameLike(trim($request->get('name'))));
        $this->supplierRepository->pushCriteria(new IsBlackEqual($request->get('is_black')));

        return $this->supplierRepository->paginate();
    }

    /**
     * 创建/修改供应商
     *
     * @param $request
     * @return array
     */
    public function createOrUpdateSupplier($request)
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
                $supplier = $this->supplierRepository->update($data, $request->get('supplier_id'));
            }else {
                $supplier = $this->supplierRepository->create($data);
            }
            if (!$supplier) {
                throw new \Exception('Create supplier failed.');
            }
            $supplier->syncContacts($request->get('contacts'));
            // 记录日志
            $msg_arr = $data;
            if ($request->get('contacts')) {
                $msg_arr['contacts'] = $request->get('contacts');
            }
            $this->supplierLogRepository->create([
                'supplier_id' => $supplier->id,
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
     * 拉黑供应商
     *
     * @param $supplier_id
     * @param $reason
     * @return array
     */
    public function blackSupplier($supplier_id, $reason)
    {
        try {
            DB::beginTransaction();
            $this->supplierRepository->update(['is_black' => 2], $supplier_id);
            $this->supplierLogRepository->create([
                'supplier_id' => $supplier_id,
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
     * 释放供应商
     *
     * @param $supplier_id
     * @return array
     */
    public function releaseSupplier($supplier_id)
    {
        try {
            DB::beginTransaction();
            $this->supplierRepository->update(['is_black' => 1], $supplier_id);
            $this->supplierLogRepository->create([
                'supplier_id' => $supplier_id,
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
     * 删除供应商
     *
     * @param $supplier_id
     * @return array
     */
    public function deleteSupplier($supplier_id)
    {
        try {
            DB::beginTransaction();
            $this->supplierRepository->delete($supplier_id);

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}