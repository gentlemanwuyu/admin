<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/20
 * Time: 21:57
 */

namespace App\Modules\Customer\Repositories\Criteria\CustomerPaymentMethodApplication;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class StatusEqual implements CriteriaInterface
{
    public function __construct($status) {
        $this->status = $status;
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
        if($this->status){
            $model = $model->where('status', $this->status);
        }

        return $model;
    }
}