<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/20
 * Time: 21:55
 */

namespace App\Modules\Customer\Repositories\Criteria\CustomerPaymentMethodApplication;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class MethodIdEqual implements CriteriaInterface
{
    public function __construct($method_id) {
        $this->method_id = $method_id;
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
        if($this->method_id){
            $model = $model->where('method_id', $this->method_id);
        }

        return $model;
    }
}