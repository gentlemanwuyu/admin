<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 8:52
 */

namespace App\Modules\Supplier\Services;

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
}