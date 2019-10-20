<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/20
 * Time: 21:51
 */

namespace App\Modules\Customer\Repositories\Criteria\CustomerPaymentMethodApplication;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use App\Modules\Customer\Models\Customer;

class NameLike implements CriteriaInterface
{
    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if($this->name){
            $customers = Customer::where('name', 'like', "%{$this->name}%")->get()->toArray();
            $customer_ids = array_column($customers, 'id');

            $model = $model->whereIn('customer_id', $customer_ids);
        }

        return $model;
    }
}