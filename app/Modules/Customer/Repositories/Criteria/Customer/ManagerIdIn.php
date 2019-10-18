<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/18
 * Time: 16:07
 */

namespace App\Modules\Customer\Repositories\Criteria\Customer;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ManagerIdIn implements CriteriaInterface
{
    public function __construct($user_ids) {
        $this->user_ids = $user_ids;
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
        if($this->user_ids){
            $model = $model->whereIn('manager_id', $this->user_ids);
        }

        return $model;
    }
}