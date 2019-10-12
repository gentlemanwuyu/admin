<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 8:52
 */

namespace App\Modules\Supplier\Services;

use Illuminate\Support\Facades\DB;
use App\Modules\Supplier\Repositories\SupplierRepository;

class SupplierService
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function getList($request)
    {
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

            DB::commit();
            return ['status' => 'success'];
        }catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'fail', 'msg'=>$e->getMessage()];
        }
    }
}